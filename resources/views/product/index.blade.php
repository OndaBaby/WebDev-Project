@extends('layouts.app')

@section('body')
    <h1>Product Listing</h1>
    <a class="btn btn-primary" href="{{ route('product.create') }}">Add Product</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Cost</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->type }}</td>
                        <td>{{ $product->cost }}</td>
                        <td><img src="{{ asset($product->img_path) }}" alt="product image" width="50" height="50"></td>
                        <td>
                            <a href="{{ route('product.edit', $product->id) }}"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('product.delete', $product->id) }}"><i class="fas fa-trash" style="color:red"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
@endsection
