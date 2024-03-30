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

@extends('layouts.app')
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
@endsection
