<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Storage;
use View;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::withTrashed()->get();
        return view('supplier.index', compact('suppliers'));
    }

    public function create()
    {
        return view('supplier.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'contact_number' => 'required|string',
            'img_path.*' => 'required|image|mimes:jpg,bmp,png|max:2048',
        ]);

        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->contact_number = $request->contact_number;

        $img_paths = [];
        if ($request->hasFile('img_path')) {
            foreach ($request->file('img_path') as $image) {
                $path = $image->store('public/images');
                $img_paths[] = str_replace('public/', 'storage/', $path);
            }
            $supplier->img_path = implode(',', $img_paths);
            $supplier->save();
        }
        return redirect()->route('supplier')->with('success', 'Supplier created successfully.');
    }

    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return View::make('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->contact_number = $request->contact_number;

        if ($request->hasFile('img_path')) {
            $newImagePaths = [];
            foreach ($request->file('img_path') as $file) {
                $path = $file->store('public/images');
                $newImagePaths[] = str_replace('public/', 'storage/', $path);
            }
            $supplier->img_path = implode(',', $newImagePaths);
        }
        $supplier->save();
        return redirect()->route('supplier')->with('success', 'Supplier updated successfully.');
    }

    public function delete($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return redirect()->route('supplier')->with('success', 'Supplier deleted successfully.');
    }

    public function restore($id)
    {
        $supplier = Supplier::withTrashed()->where('id', $id)->first();
        $supplier->restore();
        return redirect()->route('supplier')->with('success', 'Supplier restored successfully.');
    }
}
