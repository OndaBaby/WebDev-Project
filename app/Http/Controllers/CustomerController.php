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

    public function search(Request $request)
    {
        $searchQuery = $request->input('query');

        // Perform the search using LIKE query on Product name or description
        $searchResults = Product::where('name', 'like', '%' . $searchQuery . '%')
            ->orWhere('description', 'like', '%' . $searchQuery . '%')
            ->latest('created_at')
            ->get();

        // Check if the user is logged in
        if (auth()->check()) {
            return view('customer.index', compact('searchResults'));
        } else {
            return view('welcome', compact('searchResults'));
            // return redirect()->route('welcome')->with('searchResults', $searchResults);
        }
    }

    public function myorder()
    {

    }
}
