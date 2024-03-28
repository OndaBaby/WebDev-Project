<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\SalesChart;
use App\Models\Product;
use App\Models\Inventory;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function generateInventoryChart()
    {
        $data = Product::join('inventories', 'products.id', '=', 'inventories.product_id')
                        ->select('products.name', DB::raw('SUM(inventories.stock) as total_stock'))
                        ->groupBy('products.name')
                        ->orderBy('total_stock', 'asc') // Order by total_stock in ascending order
                        ->get();

        // Initialize a new SalesChart instance
        $salesChart = new SalesChart();

        // Set labels for the chart using product names
        $dataset = $salesChart->labels($data->pluck('name'));

        // Add dataset to the chart representing product inventory levels
        $dataset = $salesChart->dataset(
            'Product Sales',
            'bar',
            // Use the inverse of total_stock to prioritize products with low stock
            $data->pluck('total_stock')->map(function ($stock) {
                // Inverse of stock to prioritize low stock products
                return 1 / ($stock + 1); // Adding 1 to avoid division by zero
            })->toArray()
        );

        // Customize the background color of the dataset slices
        $dataset = $dataset->backgroundColor([
            '#7158e2',
            '#3ae374',
            '#ff3838',
        ]);

        // Set additional options for the chart
        $salesChart->options([
            'responsive' => true,
            'legend' => ['display' => true],
            'tooltips' => ['enabled' => true],
            'aspectRatio' => 1,
            'scales' => [
                'yAxes' => [
                    [
                        'display' => true,
                    ],
                ],
                'xAxes' => [
                    [
                        'gridLines' => ['display' => false],
                        'display' => true,
                    ],
                ],
            ],
        ]);
        return view('admin.analytics', compact('salesChart'));
    }
}
