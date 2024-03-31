{{-- @extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h1>Create Feedback</h1>
    <div class="container">
        <form action="{{ route('feedback.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="comment">Comment: </label>
                <input type="text" class="form-control" name="comments" required>
            </div>
            <div class="form-group">
                <label for="img_path">Image: </label>
                <input type="file" class="form-control-file" name="img_path[]" multiple required>
            </div>
            <input type="hidden" name="product_id" value="{{ request()->query('product_id') }}">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection --}}

@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h1>Create Feedback</h1>
    <div class="container">
        <div class="col-md-3 mb-4"> <!-- Use col-md-3 to make each container occupy 3 columns on medium-sized screens -->
            <div class="card shopee-card">
                <div class="card-body product-container">
                    <div id="carousel{{ $product->id }}" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach (explode(',', $product->img_path) as $key => $imgPath)
                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                <img src="{{ asset($imgPath) }}" alt="Product Image {{ $key + 1 }}" class="d-block w-100 product-image">
                            </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carousel{{ $product->id }}" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel{{ $product->id }}" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <h5 class="card-title" style="font-family: 'Roboto', sans-serif;">{{ $product->name }}</h5>
                    <p class="card-text" style="font-family: 'Roboto', sans-serif;">Type: {{ $product->type }}</p>
                    <p class="card-text" style="font-family: 'Roboto', sans-serif;">Description: {{ $product->description }}</p>
                    <p class="card-text" style="font-family: 'Roboto', sans-serif;">Cost: ₱{{ $product->cost }}</p>
                </div>
            </div>
        </div>
        <form action="{{ route('feedback.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="comment">Comment: </label>
                <input type="text" class="form-control" name="comments" required>
            </div>
            <div class="form-group">
                <label for="img_path">Image: </label>
                <input type="file" class="form-control-file" name="img_path[]" multiple required>
            </div>
           <input type="hidden" name="product_id" value="{{ request()->query('product_id') }}">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<style>
    .product-container {
        width: 100%; /* Set the desired width */
        height: 450px; /* Set the desired height */
    }
    .navbar {
        background-color: #f05026; /* Shopee orange */
        color: #ffffff; /* White */
        padding: 20px 20px;
        border-radius: 10px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-family: 'Roboto', sans-serif; /* Apply Roboto font */
        margin-bottom: 20px; /* Added margin to the bottom */
    }
    .navbar-brand {
        color: #ffffff; /* White */
        font-weight: bold;
        font-size: 1.5rem;
        text-decoration: none;
        display: flex;
        align-items: center;
    }
    .navbar-brand img {
        height: 40px; /* Adjust the height as needed */
        width: 40px; /* Adjust the width as needed */
        border-radius: 50%;
        margin-right: 10px;
    }
    .navbar-brand:hover {
        color: #ffffff; /* White */
    }
    .nav-links {
        display: flex;
        align-items: center;
    }
    .nav-link {
        color: #ffffff; /* White */
        margin: 0 1rem;
        font-weight: bold;
        text-decoration: none;
    }
    .nav-link:hover {
        color: #ffffff; /* White */
        text-decoration: underline;
    }
    .cart-icon {
        margin-left: 1rem;
        cursor: pointer;
    }
    .cart-icon svg {
        height: 30px;
        width: 30px;
    }
    .shopee-card {
        border: none;
        border-radius: 10px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .shopee-card .card-body {
        padding: 20px;
        margin-bottom: 20px; /* Added margin to the bottom */
    }

    .shopee-card .carousel-inner {
        border-radius: 10px;
    }

    .shopee-card .product-image {
        border-radius: 10px;
        height: 200px; /* Adjust the height as needed */
        object-fit: cover;
        width: 100%;
    }

    .btn-orange {
        background-color: #f05026; /* Shopee orange */
        color: #ffffff; /* White */
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        /* transition: background-color 0.3s; */
    }

    .btn-orange:hover {
        background-color: #e0401b; /* Darker shade of Shopee orange */
    }

    .logout-button.shopee-theme {
        background-color: #ee4d2d; /* Adjust the color to match your Shopee theme */
        color: #fff; /* Text color */
        padding: 8px 16px; /* Adjust padding as needed */
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .logout-button.shopee-theme:hover {
        background-color: #c6360b; /* Darker color on hover */
    }

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
