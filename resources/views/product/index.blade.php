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
@endsection --}}

{{-- @extends('layouts.app')
@section('body')
    <style>
        .carousel-item img {
            width: 80px;
            height: 80px;
        }
    </style>

    <div class="container">
        <h1>Product Listing</h1>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
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
                            <div id="imageSlider{{ $product->id }}" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach (explode(',', $product->img_path) as $key => $imgPath)
                                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                            <img src="{{ asset($imgPath) }}" class="d-block w-100" alt="Product Image">
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#imageSlider{{ $product->id }}" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#imageSlider{{ $product->id }}" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            <div id="imageSlider{{ $product->id }}" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach (explode(',', $product->img_path) as $key => $imgPath)
                                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                            <img src="{{ asset($imgPath) }}" alt="Product Image {{ $key + 1 }}" class="d-block w-100 product-image">
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#imageSlider{{ $product->id }}" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#imageSlider{{ $product->id }}" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
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
@endsection --}}


@extends('layouts.app')
@section('content')
    <style>
        .product-image {
            width: 120px; /* Adjust the width */
            height: 120px; /* Adjust the height */
            cursor: pointer;
        }

        .carousel {
            position: relative;
            width: 120px; /* Adjust the width */
            height: 120px; /* Adjust the height */
            overflow: hidden;
            margin: 0 auto;
        }

        .carousel-inner {
            display: flex;
            transition: transform 0.5s ease;
        }

        .carousel-item {
            width: 120px; /* Adjust the width */
            height: 120px; /* Adjust the height */
            flex: 0 0 auto;
        }

        .carousel-control {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 20px;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            text-align: center;
            line-height: 120px; /* Adjust the line height */
            cursor: pointer;
        }

        .carousel-control.prev {
            left: 0;
        }

        .carousel-control.next {
            right: 0;
        }
    </style>

    <div class="container">
        <h1>Product Listing</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <a class="btn btn-primary mb-3" href="{{ route('product.create') }}">Add Product</a>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Type</th>
                <th scope="col">Description</th>
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
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->cost }}</td>
                    <td>
                        <div class="carousel" id="carousel{{ $product->id }}">
                            <div class="carousel-inner">
                                @foreach (explode(',', $product->img_path) as $key => $imgPath)
                                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                        <img src="{{ asset($imgPath) }}" alt="Product Image {{ $key + 1 }}" class="d-block w-100 product-image">
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control prev" href="#carousel{{ $product->id }}" role="button" data-slide="prev">&#10094;</a>
                            <a class="carousel-control next" href="#carousel{{ $product->id }}" role="button" data-slide="next">&#10095;</a>
                        </div>
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
    </div>
@endsection
