<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use View;
use Storage;
use Redirect;

class ProductController extends Controller
{
    //Create
    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'type' => 'required|string',
            'cost' => 'required|numeric',
            'img_path' => 'required|image|mimes:jpg,bmp,png|max:2048',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->type = $request->type;
        $product->cost = $request->cost;

        if ($request->hasFile('img_path')) {
            $path = $request->file('img_path')->store('public/images');
            $product->img_path = str_replace('public/', 'storage/', $path);
        }

        $product->save();
        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    //Read
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    //Edit
    public function edit($id)
    {
        $product = Product::find($id);
        return View::make('product.edit', compact('product'));
    }

    //Update
    public function update(Request $request, $id)
    {
        if ($request->file('img_path')) {
            $path = Storage::putFileAs(
                'public/images',
                $request->file('img_path'),
                $request->file('img_path')->getClientOriginalName()
            );
            $product = Product::where('id', $id)->update([
                'name' => $request->name,
                'type' => $request->type,
                'cost' => $request->cost,
                'img_path' => 'storage/images/' . $request->file('img_path')->getClientOriginalName()
            ]);
        } else {
            $product = Product::where('id', $id)->update([
                'name' => $request->name,
                'type' => $request->type,
                'cost' => $request->cost,
            ]);
        }
        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    //Delete
    public function delete($id)
    {
        Product::destroy($id);
        return Redirect::to('product');
    }
}
