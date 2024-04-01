<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orderedProductIds = collect();

        if ($user && $user->customer) {
            // Fetch ordered product IDs for the current user
            $orderedProductIds = $user->customer->orders()->with('products')->get()->pluck('products.*.id')->flatten();
        }

        // Fetch all products
        $products = Product::all();

        // Pass the data to the view
        return view('customer.index', compact('orderedProductIds', 'products', 'user'));
    }

    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'username' => 'required|string',
            'address' => 'required|string',
            'contact_number' => 'required|string',
        ]);
        $customer = new Customer();
        $customer->user_id = $user->id;
        $customer->username = $request->input('username');
        $customer->address = $request->input('address');
        $customer->contact_number = $request->input('contact_number');
        $customer->save();
        return redirect()->route('customer.index');
    }

    public function myorder()
    {
        // Get the currently logged-in user
        $user = Auth::user();

        // Check if the user is a customer and has orders
        if ($user && $user->customer) {
            // Fetch orders related to the customer
            $orders = $user->customer->orders()->with('products')->get();

            // Loop through each order and load the product names
            $orders->each(function ($order) {
                $order->product_names = $order->products->pluck('name')->implode(', ');
            });

            return view('customer.order', compact('orders'));
        } else {
            return redirect()->back()->with('error', 'No orders found for the logged-in customer.');
        }
    }

    // public function cancelOrder(Order $order)
    // {
    //     if ($order->status === 'pending') {
    //         $order->status = 'cancelled';
    //         $order->save();
    //         return redirect()->back()->with('success', 'Order cancelled successfully.');
    //     } else {
    //         return redirect()->back()->with('error', 'Cannot cancel order. Status is not pending.');
    //     }
    // }

    public function cancelOrder(Order $order)
    {
        if ($order->status === 'Processing') {
            $products = $order->products;
            foreach ($products as $product) {
                $inventory = $product->inventory;

                if ($inventory) {
                    $inventory->stock += $order->pivot->quantity;
                    $inventory->save();
                }
            }

            // Update order status
            $order->status = 'Cancelled';
            $order->save();

            return redirect()->back()->with('success', 'Order cancelled successfully.');
        } else {
            return redirect()->back()->with('error', 'Cannot cancel order. Status is not pending.');
        }
    }
}
