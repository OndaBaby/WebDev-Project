@extends('layouts.app')
@section('body')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Product Inventory Chart</div>
                    <div class="card-body">
                        {!! $salesChart->container() !!}
                        {!! $salesChart->script() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
