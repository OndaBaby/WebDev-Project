<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // public function index()
    // {
    //     $user = Auth::user();
    //     if ($user) {
    //         $cartItems = Cart::where('customer_id', $user->customer->id)->with('product')->get();

    //         return view('cart.index', compact('cartItems'));
    //     } else {
    //         return redirect()->route('login')->with('error', 'Please login to view your cart.');
    //     }
    // }
    public function index()
    {
        $cartItems = Cart::with('productC')->get(); // Assuming you have a relationship defined as 'productC' in your Cart model
        return view('cart.index', compact('cartItems'));
    }

    public function update(Request $request, $id)
    {
        $cartItem = Cart::findOrFail($id);

        if ($request->action === 'increment') {
            $cartItem->cart_qty++;
        } elseif ($request->action === 'decrement' && $cartItem->cart_qty > 1) {
            $cartItem->cart_qty--;
        }

        $cartItem->save();

        return redirect()->route('cart.index');
    }

    public function destroy($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return redirect()->route('cart.index');
    }

    public function addToCart(Request $request)
    {
        $productId = $request->query('product_id'); // Retrieve product ID from query parameters

        // Fetch the product based on the product ID
        $product = Product::findOrFail($productId);

        $user = auth()->user();
        $customer = $user->customer;

        if (!$customer) {
            // If the user doesn't have a customer entry, redirect them to fill out the form
            return redirect()->route('customer.create');
        }

        // User has a corresponding entry in the customer table
        $customer_id = $customer->id;

        $existingCartItem = Cart::where('customer_id', $customer_id)
                                ->where('product_id', $product->id)
                                ->first();

        if ($existingCartItem) {
            // Check if $existingCartItem is an array (if query failed to retrieve a cart item)
            if (is_array($existingCartItem)) {
                // If $existingCartItem is an array, create a new Cart model instance
                $existingCartItem = new Cart();
                $existingCartItem->customer_id = $customer_id;
                $existingCartItem->product_id = $product->id;
                $existingCartItem->cart_qty = 1;
            } else {
                // Increment the cart_qty if the cart item already exists
                $existingCartItem->cart_qty++;
            }
            // Save the updated cart item
            $existingCartItem->save();
        } else {
            // If the cart item does not exist, create a new one
            $cartItem = new Cart();
            $cartItem->customer_id = $customer_id;
            $cartItem->product_id = $product->id;
            $cartItem->cart_qty = 1;
            $cartItem->save();
        }
        return redirect()->route('cart');
    }
}
