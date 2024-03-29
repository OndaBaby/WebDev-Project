<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Payement;
use App\Mail\SendOrderStatus;
use DB;
use Mail;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['products', 'customer', 'payments'])->get();

        return view('order.index', compact('orders'));
    }

    public function edit($id)
    {

    }

//     public function update(Request $request, $id)
//     {
//         // Update the order status
//         $affectedRows = Order::where('id', $id)
//             ->update(['status' => $request->status]);

//         if ($affectedRows > 0) {
//             $orderDetails = DB::table('customers as c')
//                 ->join('orders as o', 'c.id', '=', 'o.customer_id')
//                 ->join('orderlines as oi', 'o.id', '=', 'oi.order_id')
//                 ->join('products as i', 'oi.product_id', '=', 'i.id')
//                 ->where('o.id', $id)
//                 ->select('c.user_id', 'i.description', 'oi.qty', 'i.img_path', 'i.cost')
//                 ->get();

//             // Fetch user details
//             $user = DB::table('users as u')
//                 ->join('customers as c', 'u.id', '=', 'c.user_id')
//                 ->join('orders as o', 'o.customer_id', '=', 'c.id')
//                 ->where('o.id', $id)
//                 ->select('u.id', 'u.email')
//                 ->first();

//             // Send email notification
//             Mail::to($user->email)
//                 ->send(new SendOrderStatus($orderDetails));

//             return redirect()->route('order.index')->with('success', 'Order updated');
//         } else {
//             return redirect()->route('order.index')->with('error', 'Failed to update order status');
//         }
//    }

    public function update(Request $request, $id)
    {
        // Update the order status
        $affectedRows = Order::where('id', $id)
            ->update(['status' => $request->status]);

        if ($affectedRows > 0) {
            // Retrieve order details including product information
            $order = Order::with('customer.user', 'products')->find($id);

            if ($order) {
                // Prepare order details for email
                $orderDetails = $order->products->map(function ($product) {
                    return [
                        'description' => $product->description, // Assuming product name is stored in 'name' column
                        'qty' => $product->pivot->qty,
                        'img_path' => $product->img_path,
                        'cost' => $product->cost
                    ];
                });

                // Fetch user details
                $user = $order->customer->user;

                // Send email notification
                Mail::to($user->email)
                    ->send(new SendOrderStatus($orderDetails));

                return redirect()->route('order.index')->with('success', 'Order updated');
            } else {
                return redirect()->route('order.index')->with('error', 'Order not found');
            }
        } else {
            return redirect()->route('order.index')->with('error', 'Failed to update order status');
        }
    }

}
