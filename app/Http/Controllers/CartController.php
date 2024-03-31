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
            $cartProducts = Cart::where('customer_id', $user->customer->id)->with('productC')->get();
            return view('cart.index', compact('cartProducts'));
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

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Item removed from cart.');
    }

    // public function destroy($id)
    // {
    //     $cartProduct = Cart::findOrFail($id);
    //     $cartProduct->delete();

    //     return redirect()->route('cart.index');
    // }

    public function addToCart($product_id)
    {
        $user = auth()->user();

        $customer = $user->customer;

        if (!$customer) {
            return redirect()->route('customer.create');
        }

        $customer_id = $customer->id;

        // Find existing cart item for the customer and product
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

    // gumagana na check out
    // public function checkout()
    // {
    //     $user = Auth::user();
    //     if (!$user->customer) {
    //         return redirect()->route('customer.create')->with('error', 'You do not have a customer record.');
    //     }
    //     $customerId = $user->customer->id;

    //     $shippingFee = 50;

    //     try {
    //         DB::beginTransaction();

    //         // Retrieve cart items for the authenticated user
    //         $cartItems = Cart::where('customer_id', $customerId)->get();

    //         $order = Order::create([
    //             'customer_id' => $customerId,
    //             'shipping_fee' => $shippingFee,
    //             'status' => 'Pending',
    //             'date_placed' => now(),
    //             'date_shipped' => Carbon::now()->addDays(5),
    //         ]);

    //         $orderLinesValues = '';

    //         foreach ($cartItems as $cartItem) {
    //             $productId = $cartItem->product_id;
    //             $quantity = $cartItem->cart_qty;

    //             $orderLinesValues .= "($order->id, $productId, $quantity),";

    //             // Update inventory
    //             $inventory = Inventory::where('product_id', $productId)->firstOrFail();
    //             $inventory->stock -= $quantity;
    //             $inventory->save();
    //         }

    //         $orderLinesValues = rtrim($orderLinesValues, ',');

    //         if (!empty($orderLinesValues)) {
    //             $sql = "INSERT INTO orderlines (order_id, product_id, qty) VALUES $orderLinesValues";
    //             DB::statement($sql);
    //         }

    //         // Create payment entry
    //         Payment::create([
    //             'order_id' => $order->id,
    //             'mode_of_payment' => 'Cash',
    //             'date_of_payment' => now(),
    //         ]);

    //         // Delete cart items associated with the user
    //         Cart::where('customer_id', $customerId)->delete();

    //         DB::commit();

    //         return redirect()->route('cart.index')->with('success', 'Placed order successfully');
    //     } catch (Exception $e) {
    //         DB::rollback();
    //         return redirect()->route('checkout')->with('error', 'Failed to complete the checkout.');
    //     }
    // }

    public function checkout(Request $request)
    {
        $user = Auth::user();
        if (!$user->customer) {
            return redirect()->route('customer.create')->with('error', 'You do not have a customer record.');
        }
        $customerId = $user->customer->id;

        $shippingFee = 50;

        try {
            DB::beginTransaction();

            // Retrieve cart items for the authenticated user
            $cartItems = Cart::where('customer_id', $customerId)->get();

            $order = Order::create([
                'customer_id' => $customerId,
                'shipping_fee' => $shippingFee,
                'status' => 'Pending',
                'date_placed' => now(),
                // 'date_shipped' => Carbon::now()->addDays(5),
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

            // Create payment entry with the selected payment method
            Payment::create([
                'order_id' => $order->id,
                'mode_of_payment' => $request->input('payment_method'), // Retrieve selected payment method from the request
                'date_of_payment' => now(),
            ]);

            // Delete cart items associated with the user
            Cart::where('customer_id', $customerId)->delete();

            DB::commit();

            return redirect()->route('cart.index')->with('success', 'Placed order successfully');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('checkout')->with('error', 'Failed to complete the checkout.');
        }
    }

    // public function checkout()
    // {
    //     $user = Auth::user();
    //     if (!$user->customer) {
    //         return redirect()->route('customer.create')->with('error', 'You do not have a customer record.');
    //     }
    //     $customerId = $user->customer->id;

    //     $shippingFee = 50;
    //     $products = [];


    //     try {
    //         DB::beginTransaction();

    //         $order = Order::create([
    //             'customer_id' => $customerId,
    //             'shipping_fee' => $shippingFee,
    //             'status' => 'Pending',
    //             'date_placed' => now(),
    //             'date_shipped' => Carbon::now()->addDays(5),
    //         ]);

    //         $orderLinesValues = '';
    //         $inventoryUpdates = [];

    //         foreach ($products as $productId => $quantity) {
    //             $orderLinesValues .= "($order->id, $productId, $quantity),";

    //             $inventoryUpdates[] = "UPDATE inventories SET stock = stock - $quantity WHERE product_id = $productId;";
    //         }

    //         $orderLinesValues = rtrim($orderLinesValues, ',');
    //         if (!empty($orderLinesValues)) {
    //             DB::insert("INSERT INTO orderlines (order_id, product_id, qty) VALUES $orderLinesValues");
    //         }

    //         // Execute inventory update queries
    //         foreach ($inventoryUpdates as $query) {
    //             DB::statement($query);
    //         }

    //         Payment::create([
    //             'order_id' => $order->id,
    //             'mode_of_payment' => 'Cash',
    //             'date_of_payment' => now(),
    //         ]);
    //         DB::commit();

    //         return redirect()->route('cart.index')->with('success', 'Placed order successfully');
    //     } catch (Exception $e) {
    //         DB::rollback();
    //         return redirect()->route('checkout')->with('error', 'Failed to complete the checkout.');
    //     }
    // }


        // public function updateCart(Request $request)
    // {
    //     // Get the cart data from the request
    //     $cartData = $request->input('quantity');

    //     foreach ($cartData as $cartId => $quantity) {
    //         // Find the cart item
    //         $cartItem = Cart::find($cartId);

    //         if ($cartItem) {
    //             // Update the quantity
    //             $cartItem->cart_qty = $quantity;
    //             $cartItem->save();
    //         }
    //     }

    //     return redirect()->back()->with('success', 'Cart updated successfully');
    // }


    // public function checkout()
    // {
    //     $user = Auth::user();
    //     if (!$user->customer) {
    //         return redirect()->route('customer.create')->with('error', 'You do not have a customer record.');
    //     }
    //     $customerId = $user->customer->id;

    //     $shippingFee = 50;

    //     try {
    //         DB::beginTransaction();

    //         // Retrieve cart items for the authenticated user
    //         $cartItems = Cart::where('customer_id', $customerId)->get();

    //         $order = Order::create([
    //             'customer_id' => $customerId,
    //             'shipping_fee' => $shippingFee,
    //             'status' => 'Pending',
    //             'date_placed' => now(),
    //             'date_shipped' => Carbon::now()->addDays(5),
    //         ]);

    //         $orderLinesValues = '';

    //         foreach ($cartItems as $cartItem) {
    //             $productId = $cartItem->product_id;
    //             $quantity = $cartItem->cart_qty;

    //             $orderLinesValues .= "($order->id, $productId, $quantity),";

    //             // Update inventory
    //             $inventory = Inventory::where('product_id', $productId)->firstOrFail();
    //             $inventory->stock -= $quantity;
    //             $inventory->save();
    //         }

    //         $orderLinesValues = rtrim($orderLinesValues, ',');

    //         if (!empty($orderLinesValues)) {
    //             $sql = "INSERT INTO orderlines (order_id, product_id, qty) VALUES $orderLinesValues";
    //             DB::statement($sql);
    //         }

    //         // Create payment entry
    //         Payment::create([
    //             'order_id' => $order->id,
    //             'mode_of_payment' => 'Cash',
    //             'date_of_payment' => now(),
    //         ]);

    //         DB::commit();

    //         return redirect()->route('cart.index')->with('success', 'Placed order successfully');
    //     } catch (Exception $e) {
    //         DB::rollback();
    //         return redirect()->route('checkout')->with('error', 'Failed to complete the checkout.');
    //     }
    // }

    // public function addToCart(Request $request)
    // {
    //     $product_id = $request->input('product_id');
    //     $customer_id = auth()->user()->id;

    //     // Check if the product already exists in the cart
    //     $existingCartItem = Cart::where('customer_id', $customer_id)
    //         ->where('product_id', $product_id)
    //         ->first();

    //     if ($existingCartItem) {
    //         // If the product exists, increment the quantity
    //         $existingCartItem->increment('cart_qty');
    //     } else {
    //         // If the product does not exist, create a new entry in the cart
    //         Cart::create([
    //             'customer_id' => $customer_id,
    //             'product_id' => $product_id,
    //             'cart_qty' => 1, // Set default quantity to 1
    //         ]);
    //     }

    //     $this->updateSessionCart($request, $product_id, 1);

    //     return redirect()->route('customer.index');
    // }

    // private function updateSessionCart(Request $request, $product_id, $cart_qty)
    // {
    //     $cartItems = $request->session()->get('cart.items', []);

    //     // Check if the product already exists in the session cart
    //     $found = false;
    //     foreach ($cartItems as &$item) {
    //         if ($item['product_id'] == $product_id) {
    //             $item['cart_qty'] += $cart_qty;
    //             $found = true;
    //             break;
    //         }
    //     }

    //     if (!$found) {
    //         $cartItems[] = [
    //             'product_id' => $product_id,
    //             'cart_qty' => $cart_qty,
    //         ];
    //     }

    //     // Update the session cart
    //     $request->session()->put('cart.items', $cartItems);
    // }

    // public function checkout()
    // {
    //     $user = Auth::user();
    //     if (!$user->customer) {
    //         return redirect()->route('customer.create')->with('error', 'You do not have a customer record.');
    //     }

    //     $customerId = $user->customer->id;
    //     $cartItems = Cart::where('customer_id', $customerId)->get();
    //     $shippingFee = 0;

    //     DB::beginTransaction();
    //     try {
    //         $order = Order::create([
    //             'customer_id' => $customerId,
    //             'shipping_fee' => $shippingFee,
    //             'status' => 'pending',
    //             'date_placed' => now(),
    //             'date_shipped' => Carbon::now()->addDays(5),
    //         ]);

    //         foreach ($cartItems as $cartItem) {
    //             $product = Product::find($cartItem->products_id);

    //             if (!$product) {
    //                 throw new Exception("Product not found");
    //             }

    //             $order->products()->attach(
    //                 $product->id,
    //                 ['qty' => $cartItem->cart_qty]
    //             );

    //             $product->decrement('stock', $cartItem->cart_qty);
    //             $cartItem->delete();
    //         }

    //         Payment::create([
    //             'order_id' => $order->id,
    //             'mode_of_payment' => 'Cash',
    //             'date_of_payment' => now(),
    //         ]);

    //         DB::commit();
    //         return redirect()->route('cart')->with('success', 'Placed order successfully.');
    //     } catch (Exception $e) {
    //         DB::rollback();
    //         return redirect()->route('checkout')->with('error', 'Failed to complete the checkout.');
    //     }
    // }

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
}
