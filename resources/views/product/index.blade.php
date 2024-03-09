{{-- @extends('layouts.app')
@section('body')
    <div class="container">
        <h1>Product Listing</h1>
        <a class="btn btn-primary mb-3" href="{{ route('product.create') }}">Add Product</a>
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
                            <div class="d-flex">
                                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-primary mr-1"><i class="fas fa-edit"></i> Edit</a>
                                @if ($product->deleted_at === null)
                                    <form action="{{ route('product.delete', $product->id) }}" method="POST" class="delete-form">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
                                    </form>
                                @else
                                    <form action="{{ route('product.restore', $product->id) }}" method="GET">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-undo"></i> Restore</button>
                                    </form>
                                @endif
                            </div>
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
    </div>
@endsection --}}


@extends('layouts.app')

@section('body')
    <div class="container">
        <h1>Product Listing</h1>
        <a class="btn btn-primary mb-3" href="{{ route('product.create') }}">Add Product</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Cost</th>
                    <th scope="col">Images</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->type }}</td>
                        <td>{{ $product->cost }}</td>
                        <td>
                            @foreach (explode(',', $product->img_path) as $imgPath)
                                <img src="{{ asset($imgPath) }}" alt="product image" width="50" height="50">
                            @endforeach
                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-primary mr-1"><i class="fas fa-edit"></i> Edit</a>
                                @if ($product->deleted_at === null)
                                    <form action="{{ route('product.delete', $product->id) }}" method="POST" class="delete-form">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
                                    </form>
                                @else
                                    <form action="{{ route('product.restore', $product->id) }}" method="GET">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-undo"></i> Restore</button>
                                    </form>
                                @endif
                            </div>
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
    </div>
@endsection


