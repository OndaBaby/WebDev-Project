@extends('layouts.app')
@section('content')
<style>
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
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <h1>Orders</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Order Status</th>
                <th>Customer UserName</th>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Quantity</th>
                <th>Payment Method</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>
                    <form action="{{ route('order.update', $order->id) }}" method="POST">
                        @csrf
                        <select name="status" class="form-control" onchange="this.form.submit()">
                            <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                            <option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="Shipped" {{ $order->status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="Canceled" {{ $order->status == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                        </select>
                    </form>
                </td>
                <td>{{ $order->customer->username }}</td>
                <td>
                    @foreach($order->products as $product)
                    {{ $product->name }}<br>
                    @endforeach
                </td>
                <td>
                    @foreach($order->products as $product)
                    <div class="carousel" id="carousel{{ $product->id }}">
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
                    @endforeach
                </td>
                <td>
                    @foreach($order->products as $product)
                    {{ $product->pivot->qty}}<br>
                    @endforeach
                </td>
                <td>
                    @foreach($order->payments as $payment)
                    {{ $payment->mode_of_payment }}<br>
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
