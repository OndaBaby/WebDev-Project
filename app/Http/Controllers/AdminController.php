<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\UserCustomerChart;
use App\Charts\SalesChart;
use App\Charts\MonthChart;
use App\Charts\ProductChart;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\User;
use App\Models\Customer;
use App\DataTables\ProductDataTable;
use Datatables;
use DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->bgcolor = collect([
            '#7158e2',
            '#3ae374',
            '#ff3838',
            "#FF851B",
            "#7FDBFF",
            "#B10DC9",
            "#FFDC00",
            "#001f3f",
            "#39CCCC",
            "#01FF70",
            "#85144b",
            "#F012BE",
            "#3D9970",
            "#111111",
            "#AAAAAA",
        ]);
    }

    public function producttable(ProductDataTable $dataTable)
    {
        return $dataTable->render('datatable.product');
    }


    public function customer()
    {
        $customers = Customer::whereHas('user', function ($query) {
            $query->where('usertype', 'user');
        })->get();

        return view('admin.customer', compact('customers'));
    }

    public function index()
    {
        $userCount = User::where('usertype', 'user')->count();
        $customerCount = Customer::count();

        $userCustomerChart = new UserCustomerChart();

        $userCustomerChart->labels(['Users', 'Customers']);
        $userCustomerChart->dataset(
            'User vs Customer Count',
            'doughnut',
            [$userCount, $customerCount]
        )->backgroundColor([$this->bgcolor[0], $this->bgcolor[1]]); // Assigning different colors

        // Set chart options for user vs customer
        $userCustomerChart->options([
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

        $inventoryData = Product::join('inventories', 'products.id', '=', 'inventories.product_id')
            ->select('products.name', DB::raw('SUM(inventories.stock) as total_stock'))
            ->groupBy('products.name')
            ->orderBy('total_stock', 'asc')
            ->get();

        $inventoryChart = new SalesChart();

        $inventoryChart->labels($inventoryData->pluck('name'));
        $inventoryChart->dataset(
            'Product Sales',
            'bar',
            $inventoryData->pluck('total_stock')->map(function ($stock) {
                return 1 / ($stock + 1);
            })->toArray()
        )->backgroundColor([$this->bgcolor[2], $this->bgcolor[3], $this->bgcolor[4],$this->bgcolor[5],$this->bgcolor[6],$this->bgcolor[7],$this->bgcolor[8],$this->bgcolor[9]]);

        $inventoryChart->options([
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

        $sales = DB::table('orders AS o')
            ->join('orderlines AS ol', 'o.id', '=', 'ol.order_id')
            ->join('products AS p', 'ol.product_id', '=', 'p.id')
            ->orderBy(DB::raw('month(o.date_placed)'), 'ASC')
            ->groupBy(DB::raw('monthname(o.date_placed)'))
            ->pluck(
                DB::raw('sum(ol.qty * p.cost) AS total'),
                DB::raw('monthname(o.date_placed) AS month')
            )
            ->all();

        $salesChart = new MonthChart();
        $dataset = $salesChart->labels(array_keys($sales));
        $dataset = $salesChart->dataset(
            'Sales Chart',
            'bar',
            array_values($sales)
        );
        $dataset = $dataset->backgroundColor([
            '#7158e2',
            '#3ae374',
            '#ff3838',
        ]);
        $salesChart->options([
            'backgroundColor' => '#fff',
            'fill' => false,
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

        $items = DB::table('orderlines AS ol')
            ->join('products AS p', 'ol.product_id', '=', 'p.id')
            ->groupBy('p.description')
            ->orderBy('total', 'DESC')
            ->pluck(DB::raw('sum(ol.qty) AS total'), 'description')
            ->all();
        $itemChart = new ProductChart();

    $dataset = $itemChart->labels(array_keys($items));
    $dataset = $itemChart->dataset(
        'Item sold',
        'pie',
        array_values($items)
    );

    $dataset = $dataset->backgroundColor($this->bgcolor);

    $dataset = $dataset->fill(false);
    $itemChart->options([
        'responsive' => true,
        'legend' => ['display' => true],
        'tooltips' => ['enabled' => true],
        'aspectRatio' => 1,

        'scales' => [
            'yAxes' => [
                'display' => true,
                'ticks' => ['beginAtZero' => true],
                'gridLines' => ['display' => false],
                'ticks' => [
                    'beginAtZero' => true,
                    'min' => 0,
                    'stepSize' => 1,
                ]
            ],
            'xAxes' => [
                'categoryPercentage' => 0.8,
                //'barThickness' => 100,
                'barPercentage' => 1,

                'gridLines' => ['display' => false],
                'display' => true,
                'ticks' => [
                    'beginAtZero' => true,
                    'min' => 0,
                    'stepSize' => 1,
                ],
            ],
        ],
    ]);
        return view('admin.analytics', compact('userCustomerChart','inventoryChart','salesChart', 'itemChart'));
    }


        // public function generateInventoryChart()
    // {
    //     // Count the total number of users
    //     $userCount = User::where('usertype', 'user')->count();

    //     // Count the total number of customers
    //     $customerCount = Customer::count();

    //     // Retrieve inventory data
    //     $data = Product::join('inventories', 'products.id', '=', 'inventories.product_id')
    //                     ->select('products.name', DB::raw('SUM(inventories.stock) as total_stock'))
    //                     ->groupBy('products.name')
    //                     ->orderBy('total_stock', 'asc') // Order by total_stock in ascending order
    //                     ->get();

    //     $inventoryChart = new SalesChart();

    //     $dataset = $inventoryChart->labels($data->pluck('name'));

    //     // Add dataset for inventory stock
    //     $dataset = $inventoryChart->dataset(
    //         'Product Sales',
    //         'bar',
    //         $data->pluck('total_stock')->map(function ($stock) {
    //             return 1 / ($stock + 1);
    //         })->toArray()
    //     );

    //     $dataset = $dataset->backgroundColor([
    //         '#7158e2',
    //         '#3ae374',
    //         '#ff3838',
    //     ]);

    //     // Set chart options for inventory
    //     $inventoryChart->options([
    //         'responsive' => true,
    //         'legend' => ['display' => true],
    //         'tooltips' => ['enabled' => true],
    //         'aspectRatio' => 1,
    //         'scales' => [
    //             'yAxes' => [
    //                 [
    //                     'display' => true,
    //                 ],
    //             ],
    //             'xAxes' => [
    //                 [
    //                     'gridLines' => ['display' => false],
    //                     'display' => true,
    //                 ],
    //             ],
    //         ],
    //     ]);

    //     // Initialize chart for user vs customer
    //     $userCustomerChart = new UserCustomerChart();

    //     // Add labels and dataset for user vs customer count
    //     $userCustomerChart->labels(['Users', 'Customers']);
    //     $userCustomerChart->dataset(
    //         'User vs Customer Count',
    //         'doughnut',
    //         [$userCount, $customerCount]
    //     )->backgroundColor(['#ff3838', '#fbbd08']);

    //     // Set chart options for user vs customer
    //     $userCustomerChart->options([
    //         'responsive' => true,
    //         'legend' => ['display' => true],
    //         'tooltips' => ['enabled' => true],
    //         'aspectRatio' => 1,
    //         'scales' => [
    //             'yAxes' => [
    //                 [
    //                     'display' => true,
    //                 ],
    //             ],
    //             'xAxes' => [
    //                 [
    //                     'gridLines' => ['display' => false],
    //                     'display' => true,
    //                 ],
    //             ],
    //         ],
    //     ]);

    //     // Return view with both charts data
    //     return view('admin.analytics', compact('inventoryChart', 'userCustomerChart'));
    // }
}
