<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Inventory;
use View;
use Storage;
use Redirect;


class ProductController extends Controller
{
    public function welcome()
    {
        $products = Product::all();
        return view('welcome', compact('products'));
    }

    public function index()
    {
        $products = Product::withTrashed()->get();
        return view('product.index', compact('product'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'type' => 'required|string',
            'description' => 'required|string',
            'cost' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'img_path.*' => 'required|image|mimes:jpg,bmp,png|max:2048',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->type = $request->type;
        $product->description = $request->description;
        $product->cost = $request->cost;

        $img_paths = [];
        if ($request->hasFile('img_path')) {
            foreach ($request->file('img_path') as $image) {
                $path = $image->store('public/images');
                $img_paths[] = str_replace('public/', 'storage/', $path);
            }
            $product->img_path = implode(',', $img_paths);
            $product->save();
        }

        $inventory = new Inventory();
        $inventory->product_id = $product->id;
        $inventory->stock = $request->stock;
        $inventory->save();

        return redirect()->route('product')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return View::make('product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->name = $request->name;
        $product->type = $request->type;
        $product->description = $request->description;
        $product->cost = $request->cost;

        if ($request->hasFile('img_path')) {
            $newImagePaths = [];
            foreach ($request->file('img_path') as $file) {
                $path = $file->store('public/images');
                $newImagePaths[] = str_replace('public/', 'storage/', $path);
            }
            $product->img_path = implode(',', $newImagePaths);
        }
        $product->save();
        return redirect()->route('product')->with('success', 'Product updated successfully.');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('product')->with('success', 'Product deleted successfully.');
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->where('id', $id)->first();
        $product->restore();
        return redirect()->route('product')->with('success', 'Product restored successfully.');
    }
}
