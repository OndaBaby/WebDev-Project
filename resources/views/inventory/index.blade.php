
@extends('layouts.app')

@section('content')
<style>
    body {
    background-image: url('{{ asset('storage/images/orange.png') }}');
    background-size: cover;
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Inventory List</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inventories as $inventory)
                            <tr>
                                <td>{{ $inventory->product->name }}</td>
                                <td>{{ $inventory->stock }}</td>
                                <td>
                                    <a href="{{ route('inventory.edit', $inventory->product_id) }}" class="btn btn-primary">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
