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
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['products', 'customer', 'payments'])->get();

        return view('order.index', compact('orders'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::where('id', $id)
            ->update(['status' => $request->status, 'date_shipped' => Carbon::now()->addDays(3)]);

        if ($order > 0) {
            $myOrder = DB::table('customers as c')
                ->join('orders as o', 'o.customer_id', '=', 'c.id')
                ->join('orderlines as ol', 'o.id', '=', 'ol.order_id')
                ->join('products as p', 'ol.product_id', '=', 'p.id')
                ->where('o.id', $id)
                ->select('c.user_id', 'p.name', 'ol.qty', 'p.img_path', 'p.cost', 'o.status')
                ->get();

            $orderTotal = $myOrder->sum(function ($item) {
                return $item->qty * $item->cost;
            });
            
            $totalOrder = $orderTotal + $shippingFee;

            $user =  DB::table('users as u')
                ->join('customers as c', 'u.id', '=', 'c.user_id')
                ->join('orders as o', 'o.customer_id', '=', 'c.id')
                ->where('o.id', $id)
                ->select('u.id', 'u.email')
                ->first();

            Mail::to($user->email)
                ->send(new SendOrderStatus($myOrder, $shippingFee, $totalOrder));

            return redirect()->route('order.index')->with('success', 'Order updated');
        }

        return redirect()->route('order.index')->with('error', 'Email not sent');
    }
}
