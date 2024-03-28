<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Product;

class CustomerController extends Controller
{
    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        // Validate the request data
        $request->validate([
            'username' => 'required|string',
            'address' => 'required|string',
            'contact_number' => 'required|string',
        ]);

        // Create a new customer entry
        $customer = new Customer();
        $customer->user_id = $user->id;
        $customer->username = $request->input('username');
        $customer->address = $request->input('address');
        $customer->contact_number = $request->input('contact_number');
        $customer->save();

        // Redirect to the add to cart page after creating the customer
        return redirect()->route('customer.index');
    }

    // public function search(Request $request)
    // {
    //     $searchQuery = $request->input('search');

    //     if (!$searchQuery) {
    //         return redirect()->route('customer.index');
    //     }
    //     $searchResults = Product::where('name', 'like', '%' . $searchQuery . '%')
    //         ->orWhere('cost', 'like', '%' . $searchQuery . '%')
    //         ->orWhere('type', 'like', '%' . $searchQuery . '%')
    //         ->latest('created_at')
    //         ->get();

    //     return view('customer.index', ['searchResults' => $searchResults, 'query' => $searchQuery]);
    // }

    public function index()
    {
        $products = Product::all();
        return view('customer.index', compact('products'));
    }

}
