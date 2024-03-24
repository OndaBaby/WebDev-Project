@extends('layouts.base')
@section('content')
    <style>
        .product-image {
            width: 120px;
            height: 120px;
            cursor: pointer;
        }

        .carousel {
            position: relative;
            width: 120px;
            height: 120px;
            overflow: hidden;
            margin: 0 auto;
        }

        .carousel-inner {
            display: flex;
            transition: transform 0.5s ease;
        }

        .carousel-item {
            width: 120px;
            height: 120px;
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
            line-height: 120px; 
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
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <a class="btn btn-primary mb-3" href=#>My Cart</a>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">Type: {{ $product->type }}</p>
                            <p class="card-text">Cost: {{ $product->cost }}</p>
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
                            <a href="{{ route('add.to.cart', $product->id)}}" class="btn btn-primary mt-3">Add to Cart</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
