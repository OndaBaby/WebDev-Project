<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Inventory;
use Illuminate\Support\Facades\Auth;
use DB;
use Session;
use Exception;
use Carbon\Carbon;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user) {
            $customerId = $user->customer->id;
            $cartProducts = Cart::where('customer_id', $customerId)->with('productC')->get();

            $cartTotal = $cartProducts->sum(function ($cartProduct) {
                return $cartProduct->productC->cost * $cartProduct->cart_qty;
            });

            return view('cart.index', compact('cartProducts', 'cartTotal'));
        } else {
            return redirect()->route('login')->with('error', 'Please login to view your cart.');
        }
    }

    public function reduceByOne($productId)
    {
        $cartItem = Cart::where('product_id', $productId)->firstOrFail();

        if ($cartItem->cart_qty > 1) {
            $cartItem->cart_qty--;
            $cartItem->save();
        } else {
            $cartItem->delete();
        }

        return redirect()->back()->with('success', 'Item quantity decreased.');
    }

    public function addByOne($productId)
    {
        $cartItem = Cart::where('product_id', $productId)->firstOrFail();

        $cartItem->cart_qty++;
        $cartItem->save();

        return redirect()->back()->with('success', 'Item quantity increased.');
    }

    public function delete($productId)
    {
        DB::table('carts')->where('product_id', $productId)->delete();
        return redirect()->back()->with('success', 'Item removed from cart.');
    }

    public function addToCart($product_id)
    {
        $user = auth()->user();

        $customer = $user->customer;

        if (!$customer) {
            return redirect()->route('customer.create');
        }

        $customer_id = $customer->id;

        $existingCartItem = Cart::where('customer_id', $customer_id)
            ->where('product_id', $product_id)
            ->first();

        if ($existingCartItem) {
            $existingCartItem->update(['cart_qty' => $existingCartItem->cart_qty + 1]);
        } else {
            $cartItem = Cart::create([
                'customer_id' => $customer->id,
                'product_id' => $product_id,
                'cart_qty' => 1,
            ]);
        }
        return redirect()->route('customer.index');
    }

    public function checkout(Request $request)
    {
        $user = Auth::user();
        $customerId = $user->customer->id;

        $shippingFee = 60;

        try {
            DB::beginTransaction();

            $cartItems = Cart::where('customer_id', $customerId)->get();

            $order = Order::create([
                'customer_id' => $customerId,
                'shipping_fee' => $shippingFee,
                'status' => 'Pending',
                'date_placed' => now(),
            ]);

            $orderLinesValues = '';

            foreach ($cartItems as $cartItem) {
                $productId = $cartItem->product_id;
                $quantity = $cartItem->cart_qty;

                $orderLinesValues .= "($order->id, $productId, $quantity),";

                $inventory = Inventory::where('product_id', $productId)->firstOrFail();
                $inventory->stock -= $quantity;
                $inventory->save();
            }

            $orderLinesValues = rtrim($orderLinesValues, ',');

            if (!empty($orderLinesValues)) {
                $sql = "INSERT INTO orderlines (order_id, product_id, qty) VALUES $orderLinesValues";
                DB::statement($sql);
            }
            Payment::create([
                'order_id' => $order->id,
                'mode_of_payment' => $request->input('payment_method'),
                'date_of_payment' => now(),
            ]);
            Cart::where('customer_id', $customerId)->delete();

            DB::commit();
            return redirect()->route('cart.index')->with('success', 'Placed order successfully');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('checkout')->with('error', 'Failed to complete the checkout.');
        }
    }







    /* may condition sa shippingfeee
    public function index()
    {
        $user = Auth::user();
        if ($user) {
            $customerId = $user->customer->id;

            // Retrieve cart products for the authenticated user
            $cartProducts = Cart::where('customer_id', $customerId)->with('productC')->get();

            // Calculate the total cart amount
            $cartTotal = $cartProducts->sum(function ($cartProduct) {
                return $cartProduct->productC->cost * $cartProduct->cart_qty;
            });

            // Determine the shipping fee based on the cart total
            $shippingFee = $cartTotal > 2000 ? 100 : 60;

            // Pass the cart products, cart total, and shipping fee to the view
            return view('cart.index', compact('cartProducts', 'cartTotal', 'shippingFee'));
        } else {
            return redirect()->route('login')->with('error', 'Please login to view your cart.');
        }
    }

    public function checkout(Request $request)
    {
        $user = Auth::user();
        $customerId = $user->customer->id;

        try {
            DB::beginTransaction();
            $cartItems = Cart::where('customer_id', $customerId)->get();

            $order = Order::create([
                'customer_id' => $customerId,
                'shipping_fee' => $shippingFee,
                'status' => 'Pending',
                'date_placed' => now(),
            ]);

            $orderLinesValues = '';

            foreach ($cartItems as $cartItem) {
                $productId = $cartItem->product_id;
                $quantity = $cartItem->cart_qty;

                $orderLinesValues .= "($order->id, $productId, $quantity),";

                // Update inventory
                $inventory = Inventory::where('product_id', $productId)->firstOrFail();
                $inventory->stock -= $quantity;
                $inventory->save();
            }

            $orderLinesValues = rtrim($orderLinesValues, ',');

            if (!empty($orderLinesValues)) {
                $sql = "INSERT INTO orderlines (order_id, product_id, qty) VALUES $orderLinesValues";
                DB::statement($sql);
            }
            Payment::create([
                'order_id' => $order->id,
                'mode_of_payment' => $request->input('payment_method'),
                'date_of_payment' => now(),
            ]);
            Cart::where('customer_id', $customerId)->delete();

            DB::commit();
            return redirect()->route('cart.index')->with('success', 'Placed order successfully');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('checkout')->with('error', 'Failed to complete the checkout.');
        }
    } */
}
