@extends('layouts.master')

@section('body')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <a class="btn btn-primary mb-3" href="{{ route('cart.index') }}">
            <i class="fas fa-shopping-cart" aria-hidden="true"></i> My Cart
            <span class="badge bg-danger">{{ count(session('cart.items', [])) }}</span>
        </a>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">Type: {{ $product->type }}</p>
                            <p class="card-text">Cost: {{ $product->cost }}</p>
                            <div id="carousel{{ $product->id }}" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach (explode(',', $product->img_path) as $key => $imgPath)
                                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                            <img src="{{ asset($imgPath) }}" alt="Product Image {{ $key + 1 }}" class="d-block w-100 product-image">
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carousel{{ $product->id }}" role="button" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden"></span>
                                </a>
                                <a class="carousel-control-next" href="#carousel{{ $product->id }}" role="button" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden"></span>
                                </a>
                            </div>
                            <form action="{{ route('cart.add') }}" method="GET">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <style>
        .product-image {
            width: 100%;
            height: auto;
            cursor: pointer;
        }

        .carousel {
            width: 100%;
            height: 200px;
            overflow: hidden;
        }

        .carousel-inner {
            display: flex;
        }

        .carousel-item {
            width: 100%;
            transition: transform 0.5s ease;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 3%;
            top: 50%;
            transform: translateY(-50%);
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            width: 30px;
            height: 30px;
        }
    </style>
@endsection
