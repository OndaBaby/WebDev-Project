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
            $orderedProductIds = $user->customer->orders()->with('products')->get()->pluck('products.*.id')->flatten();
        }
        $products = Product::all();
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

    }
}
