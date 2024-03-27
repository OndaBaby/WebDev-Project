<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Product;
class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::with('product')->get();
        return view('inventory.index', compact('inventories'));
    }

    public function edit($productId)
    {
        $inventory = Inventory::where('product_id', $productId)->firstOrFail();
        return view('inventory.edit', compact('inventory'));
    }

    public function update(Request $request, $productId)
    {
        // Find the inventory record with the given product_id
        $inventory = Inventory::where('product_id', $productId)->firstOrFail();

        // Update the stock of the found inventory record
        $inventory->stock = $request->stock;
        $inventory->save();

        // Redirect back to the inventory index page with a success message
        return redirect()->route('inventory')->with('success', 'Inventory stock updated successfully.');
    }
}
