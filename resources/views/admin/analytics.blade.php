{{-- @extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Product Inventory Chart</div>
                    <div class="card-body">
                        {!! $inventoryChart->container() !!}
                        {!! $inventoryChart->script() !!}
                    </div>
                    <div class="card-header">Product Inventory Chart</div>
                    <div class="card-body">
                        {!! $userCustomerChart->container() !!}
                        {!! $userCustomerChart->script() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}

@extends('layouts.app')
@section('content')
<style>
    .chart-card {
        margin-bottom: 20px;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .chart-container {
        width: 100%;
        height: auto;
    }

    .container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .chart-card {
        width: 48%; /* Adjust width as needed */
    }
</style>
<div class="container">
    <div class="chart-card">
        <div class="chart-container">
            {!! $salesChart->container() !!}
        </div>
    </div>

    <div class="chart-card">
        <div class="chart-container">
            {!! $inventoryChart->container() !!}
        </div>
    </div>
</div>

<div class="container">
    <div class="chart-card">
        <div class="chart-container">
            {!! $itemChart->container() !!}
        </div>
    </div>

    <div class="chart-card">
        <div class="chart-container">
            {!! $userCustomerChart->container() !!}
        </div>
    </div>
</div>

{!! $salesChart->script() !!}
{!! $inventoryChart->script() !!}
{!! $itemChart->script() !!}
{!! $userCustomerChart->script() !!}
@endsection
