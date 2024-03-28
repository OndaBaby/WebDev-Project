<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use DB;
use Session;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user) {
            $cartProducts = Cart::where('customer_id', $user->customer->id)->with('productC')->get();
            return view('cart.index', compact('cartProducts'));
        } else {
            return redirect()->route('login')->with('error', 'Please login to view your cart.');
        }
    }

    public function update(Request $request, $id)
    {
        $cartProduct = Cart::findOrFail($id);

        if ($request->action === 'increment') {
            $cartProduct->cart_qty++;
        } elseif ($request->action === 'decrement' && $cartProduct->cart_qty > 1) {
            $cartProduct->cart_qty--;
        }

        $cartProduct->save();

        return redirect()->route('cart.index');
    }

    public function destroy($id)
    {
        $cartProduct = Cart::findOrFail($id);
        $cartProduct->delete();

        return redirect()->route('cart.index');
    }

    public function addToCart(Request $request)
    {
        $product_id = $request->input('product_id');
        $customer_id = auth()->user()->id;

        // Check if the product already exists in the cart
        $existingCartItem = Cart::where('customer_id', $customer_id)
            ->where('product_id', $product_id)
            ->first();

        if ($existingCartItem) {
            // If the product exists, increment the quantity
            $existingCartItem->increment('cart_qty');
        } else {
            // If the product does not exist, create a new entry in the cart
            Cart::create([
                'customer_id' => $customer_id,
                'product_id' => $product_id,
                'cart_qty' => 1, // Set default quantity to 1
            ]);
        }

        // Update the session cart
        $this->updateSessionCart($request, $product_id, 1);

        return redirect()->route('customer.index');
    }

    private function updateSessionCart(Request $request, $product_id, $cart_qty)
    {
        $cartItems = $request->session()->get('cart.items', []);

        // Check if the product already exists in the session cart
        $found = false;
        foreach ($cartItems as &$item) {
            if ($item['product_id'] == $product_id) {
                $item['cart_qty'] += $cart_qty;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cartItems[] = [
                'product_id' => $product_id,
                'cart_qty' => $cart_qty,
            ];
        }

        // Update the session cart
        $request->session()->put('cart.items', $cartItems);
    }

    // public function addToCart(Request $request)
    // {
    //     $productId = $request->query('product_id');

    //     $product = Product::findOrFail($productId);

    //     $user = auth()->user();
    //     $customer = $user->customer;

    //     if (!$customer) {
    //         return redirect()->route('customer.create');
    //     }

    //     $customer_id = $customer->id;

    //     // Fetch the existing cart Product for the current customer and product
    //     $existingCartProduct = Cart::where('customer_id', $customer_id)
    //                             ->where('product_id', $product->id)
    //                             ->first();

    //     if ($existingCartProduct) {
    //         // If the cart Product already exists, increment the cart_qty
    //         $existingCartProduct->increment('cart_qty'); // Increment cart_qty by 1
    //     } else {
    //         // If the cart Product does not exist, create a new one
    //         $cartProduct = new Cart();
    //         $cartProduct->customer_id = $customer_id;
    //         $cartProduct->product_id = $product->id;
    //         $cartProduct->cart_qty = 1;
    //         $cartProduct->save();
    //     }
    //     return redirect()->route('customer.index');
    // }

    public function checkout(Request $request)
    {
        $user = Auth::user();

        DB::beginTransaction();

        try {
            $order = new Order();
            $order->customer_id = $user->id;
            $order->shipping_fee = 50;
            $order->status = 'Processing';
            $order->dateplaced = now();
            $order->date_shipped = null;
            $order->save();

            foreach ($user->cartItems as $cartItem) {
                $order->products()->attach($cartItem->product_id, ['cart_qty' => $cartItem->quantity]);

                $product = Product::find($cartItem->product_id);
                $product->stock -= $cartItem->quantity;
                $product->save();
            }

            // Clear the user's cart after checkout
            $user->cartItems()->delete();

            DB::commit();

            return redirect()->route('home')->with('success', 'Your order has been placed successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Failed to process your order. Please try again.');
        }
    }

    // public function addToCart($id)
    // {
    //     $Product = Product::find($id);
    //     $oldCart = Session::has('cart') ? Session::get('cart') : null;
    //     // dd($oldCart);
    //     $cart = new Cart($oldCart);
    //     // dd($cart);
    //     $cart->add($Product, $Product->Product_id);
    //     Session::put('cart', $cart);
    //     Session::save();

    //     return redirect('/')->with('info', 'product added to cart');
    // }

    // public function getCart()
    // {
    //     if (!Session::has('cart')) {
    //         return view('shop.shopping-cart');
    //     }
    //     $oldCart = Session::get('cart');
    //     $cart = new Cart($oldCart);
    //     return view('cart.index', ['products' => $cart->products, 'totalPrice' => $cart->totalPrice]);
    // }

    // public function getReduceByOne($id)
    // {
    //     $oldCart = Session::has('cart') ? Session::get('cart') : null;
    //     $cart = new Cart($oldCart);
    //     $cart->reduceByOne($id);
    //     if (count($cart->products) > 0) {
    //         Session::put('cart', $cart);
    //         Session::save();
    //     } else {
    //         Session::forget('cart');
    //     }
    //     return redirect()->route('cart.index');
    // }

    // public function getRemoveItem($id)
    // {
    //     $oldCart = Session::has('cart') ? Session::get('cart') : null;
    //     $cart = new Cart($oldCart);
    //     $cart->removeItem($id);
    //     if (count($cart->products) > 0) {
    //         Session::put('cart', $cart);
    //         Session::save();
    //     } else {
    //         Session::forget('cart');
    //     }
    //     return redirect()->route('getCart');
    // }


    // public function addToCart(Request $request, $productId)
    // {
    //     // Get the authenticated user
    //     $user = auth()->user();

    //     // Check if the user has associated customer data
    //     if (!$user->customer) {
    //         return redirect()->route('customer.create');
    //     }

    //     $product = Product::find($productId);
    //     $cart_qty = $request->input('cart_qty', 1);
    //     $customerId = $user->customer->id;

    //     if ($cart = DB::table('carts')->where('customer_id', $customerId)->where('product_id', $productId)->first()) {
    //         DB::table('carts')->where('customer_id', $customerId)->where('product_id', $productId)->update([
    //             'cart_qty' => $cart->cart_qty + $cart_qty,
    //             'created_at' => now()
    //         ]);
    //     } else {
    //         $cartId = DB::table('carts')->insertGetId([
    //             'customer_id' => $customerId,
    //             'product_id' => $productId,
    //             'cart_qty' => $cart_qty,
    //         ]);
    //     }
    //     return redirect()->route('cart.add', ['productId' => $productId]);
    // }
}
