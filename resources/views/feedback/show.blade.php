{{-- @extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Feedback for Product: {{ $productName }}</h1>
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Comment</th>
                        <th>Images</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($feedbacks as $index => $feedback)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $feedback->customer->username }}</td>
                        <td>{{ $feedback->comments }}</td>
                        <td>
                            @if($feedback->img_path)
                                @foreach(explode(',', $feedback->img_path) as $image)
                                    <img src="{{ asset($image) }}" alt="Feedback Image" width="60" height="60">
                                @endforeach
                            @else
                                No images
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">No feedback available for this product.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection --}}

{{-- @extends('layouts.app')
@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-10 offset-md-1">
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
    </div>
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Comment</th>
                        <th>Images</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($feedbacks as $index => $feedback)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $feedback->customer->username }}</td>
                        <td>{{ $feedback->comments }}</td>
                        <td>
                            @if($feedback->img_path)
                            @foreach(explode(',', $feedback->img_path) as $image)
                            <img src="{{ asset($image) }}" alt="Feedback Image" width="60" height="60">
                            @endforeach
                            @else
                            No images
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">No feedback available for this product.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection --}}

@extends('layouts.app')
@section('content')

<style>

    .shopee-card {
        border: none;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .product-container {
    padding: 10px;
    max-width: 600px; /* Set maximum width for the product container */
    margin: 0 auto; /* Center the product container */
    text-align: center; /* Center align the contents */
    border-radius: 7px; /* Make the container round */
}
    .product-image {
        max-width: 500px; /* Set maximum width for the image */
        height: 300px; /* Set fixed height for the image */
        object-fit: cover; /* Maintain aspect ratio and fill the container */
        background-color: transparent; /* Ensure transparent background */
        margin: 0 auto; /* Center the image */
    }

    .carousel-control-prev, .carousel-control-next {
        width: 5%; /* Adjust control button size */
    }

    .carousel-control-prev-icon, .carousel-control-next-icon {
        background-image: none; /* Remove default icons */
    }

    .card-title {
        font-family: 'Roboto', sans-serif;
        font-size: 1.25rem; /* Increase font size */
        margin-bottom: 10px;
    }

    .card-text {
        font-family: 'Roboto', sans-serif;
        font-size: 1rem; /* Adjust font size */
        margin-bottom: 5px;
        text-align: left; /* Align text to the right */
    }

    .table-bordered {
        border: 1px solid #dee2e6; /* Add border to table */
        border-radius: 5px; /* Round table corners */
    }

    .table th, .table td {
        padding: 8px; /* Adjust cell padding */
    }

    body {
        background-image: url('{{ asset('storage/images/orange.png') }}');
        background-size: cover;
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center"> <!-- Changed to center justify the row -->
        <div class="col-md-5"> <!-- Removed offset-md-1 -->
            <div class="card shopee-card">
                <div class="card-body product-container"> <!-- Removed white background -->
                    <div id="carousel{{ $product->id }}" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach (explode(',', $product->img_path) as $key => $imgPath)
                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                <img src="{{ asset($imgPath) }}" alt="Product Image {{ $key + 1 }}" class="d-block product-image">
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
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">Type: {{ $product->type }}</p>
                    <p class="card-text">Description: {{ $product->description }}</p>
                    <p class="card-text">Cost: ₱{{ $product->cost }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

    <p></p>
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Comment</th>
                        <th>Images</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($feedbacks as $index => $feedback)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $feedback->customer->username }}</td>
                        <td>{{ $feedback->comments }}</td>
                        <td>
                            @if($feedback->img_path)
                            @foreach(explode(',', $feedback->img_path) as $image)
                            <img src="{{ asset($image) }}" alt="Feedback Image" width="60" height="60">
                            @endforeach
                            @else
                            No images
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">No feedback available for this product.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
