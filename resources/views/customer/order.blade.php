{{-- @extends('layouts.app')
@section('content')
    <h1>My Orders</h1>
    @if (count($orders) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            @if ($order->status === 'Processing')
                                <form action="{{ route('cancel.order', $order->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Cancel</button>
                                </form>
                            @elseif ($order->status === 'Shipped')
                                Your order is shipped already!
                            @else
                                Order Compeleted | Delivered
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No orders found for the logged-in customer.</p>
    @endif
@endsection --}}
{{--
@extends('layouts.app')
@section('content')
<style>
    .carousel {
        position: relative;
        width: 120px; /* Adjust the width */
        height: 130px; /* Adjust the height */
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
    body {
    background-image: url('{{ asset('storage/images/orange.png') }}');
    background-size: cover;
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">My Orders</div>

<div class="container">
    @if (count($orders) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Order Placed</th>
                    <th>Product Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->date_placed }}</td>
                        <td>
                            <ul>
                                @foreach($order->products as $product)
                                    <li>{{ $product->name }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $order->status }}</td>
                        <td>
                            @if ($order->status === 'Pending')
                                <form action="{{ route('cancel.order', $order->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Cancel</button>
                                </form>
                            @elseif ($order->status === 'Shipped')
                                Your order is shipped already!
                            @else
                                Order Completed | Delivered
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No orders found for the logged-in customer.</p>
    @endif
@endsection --}}


@extends('layouts.app')
@section('content')
<style>
    .carousel {
        position: relative;
        width: 120px; /* Adjust the width */
        height: 130px; /* Adjust the height */
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
    body {
    background-image: url('{{ asset('storage/images/orange.png') }}');
    background-size: cover;
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">My Orders</div>

<div class="container">
    @if (count($orders) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Order Placed</th>
                    <th>Product Name</th>
                    <th>Status</th>
                    @if ($orders->first()->date_shipped !== null)
                        <th>Date Shipped</th>
                    @endif
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->date_placed }}</td>
                        <td>
                            <ul>
                                @foreach($order->products as $product)
                                    <li>{{ $product->name }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $order->status }}</td>
                        @if ($order->date_shipped !== null)
                            <td>{{ $order->date_shipped }}</td>
                        @endif
                        <td>
                            @if ($order->status === 'Pending')
                                <form action="{{ route('cancel.order', $order->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Cancel</button>
                                </form>
                            @elseif ($order->status === 'Shipped')
                                Your order is shipped already!
                            @else
                                Order Completed | Delivered
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No orders found for the logged-in customer.</p>
    @endif
@endsection
