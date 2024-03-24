<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

class UserController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('user.index', compact('products'));
    }

    // public function addToCart(Request $request, $id)
    // {
    //     $product = Product::findOrFail($id);

    //     $customerId = auth()->user()->id;

    //     $existingCartItem = Cart::where('customer_id', $customerId)
    //                             ->where('product_id', $productId)
    //                             ->first();

    //     if ($existingCartItem) {
    //         $existingCartItem->quantity += $request->quantity;
    //         $existingCartItem->save();
    //     } else {
    //         $cartItem = new Cart();
    //         $cartItem->customer_id = $customerId;
    //         $cartItem->product_id = $productId;
    //         $cartItem->quantity = $request->quantity;
    //         $cartItem->save();
    //     }

    //     // Redirect back or show a success message
    //     return redirect()->back()->with('success', 'Product added to cart successfully!');
    // }

}
