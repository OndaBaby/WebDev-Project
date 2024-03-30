<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

class UserController extends Controller
{
    // public function welcome()
    // {
    //     $products = Product::all();
    //     return view('welcome', compact('products'));
    // }

    public function search(Request $request)
    {
        // $searchQuery = $request->input('query');

        // // Perform the search using LIKE query on Product name or description
        // $searchResults = Product::where('name', 'like', '%' . $searchQuery . '%')
        //     ->orWhere('description', 'like', '%' . $searchQuery . '%')
        //     ->latest('created_at')
        //     ->get();

        // // Check if the user is logged in
        // if (auth()->check()) {
        //     return view('customer.index', compact('searchResults'));
        // } else {
        //     return view('welcome', compact('searchResults'));
        //     // return redirect()->route('welcome')->with('searchResults', $searchResults);
        // }

        $searchQuery = $request->input('query');

        // Perform the search using LIKE query on Product name or description
        $searchResults = Product::where('name', 'like', '%' . $searchQuery . '%')
            ->orWhere('description', 'like', '%' . $searchQuery . '%')
            ->latest('created_at')
            ->get();

            $products = Product::all();

        // Check if the user is logged in
        if (auth()->check()) {
            return view('customer.index', compact('searchResults', 'products'));
        } else {
            return view('welcome', compact('searchResults', 'products'));
            // return redirect()->route('welcome')->with('searchResults', $searchResults);
        }
    }
}
