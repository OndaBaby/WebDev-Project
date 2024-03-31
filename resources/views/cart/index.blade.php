{{-- @extends('layouts.app')
@section('content')

    <div class="container">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <h1>Cart</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Type</th>
                                <th>Cost</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartProducts as $cartProduct)
                                <tr>
                                    <td>{{ $cartProduct->productC->name }}</td>
                                    <td>{{ $cartProduct->productC->type }}</td>
                                    <td>{{ $cartProduct->productC->cost }}</td>
                                    <td>{{ $cartProduct->cart_qty }}</td>
                                    <td>
                                        <a href="{{ route('reduceByOne', $cartProduct->productC->id) }}" class="btn btn-danger btn-sm">
                                            <i class="fas fa-minus"></i>
                                        </a>
                                        <a href="{{ route('addByOne', $cartProduct->productC->id) }}" class="btn btn-success btn-sm">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                        <a href="{{ route('cart.delete', $cartProduct->productC->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('checkout') }}" class="btn btn-primary">Checkout</a>
            </div>
        </div>
    </div>
@endsection --}}



{{-- @extends('layouts.app')  eto yung gumagana 03/31/2024
@section('content')

    <div class="container">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <h1>Cart</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Type</th>
                                <th>Cost</th>
                                <th>Quantity</th>
                                <th>Partial Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $cartTotal = 0; // Initialize cart total
                            @endphp
                            @foreach($cartProducts as $cartProduct)
                                <tr>
                                    <td>{{ $cartProduct->productC->name }}</td>
                                    <td>{{ $cartProduct->productC->type }}</td>
                                    <td>{{ $cartProduct->productC->cost }}</td>
                                    <td>{{ $cartProduct->cart_qty }}</td>
                                    <td>{{ $partialTotal = $cartProduct->productC->cost * $cartProduct->cart_qty }}</td>
                                    <td>
                                        <a href="{{ route('reduceByOne', $cartProduct->productC->id) }}" class="btn btn-danger btn-sm">
                                            <i class="fas fa-minus"></i>
                                        </a>
                                        <a href="{{ route('addByOne', $cartProduct->productC->id) }}" class="btn btn-success btn-sm">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                        <a href="{{ route('cart.delete', $cartProduct->productC->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @php
                                    $cartTotal += $partialTotal; // Accumulate partial total to cart total
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <p>Total Cart Amount: {{ $cartTotal }}</p>
                    <a href="{{ route('checkout') }}" class="btn btn-primary">Checkout</a>
            </div>
        </div>
    </div>
@endsection --}}


@extends('layouts.app')
@section('content')

    <div class="container">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <h1>Cart</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Type</th>
                                <th>Cost</th>
                                <th>Quantity</th>
                                <th>Partial Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $cartTotal = 0; // Initialize cart total
                            @endphp
                            @foreach($cartProducts as $cartProduct)
                                <tr>
                                    <td>{{ $cartProduct->productC->name }}</td>
                                    <td>{{ $cartProduct->productC->type }}</td>
                                    <td>{{ $cartProduct->productC->cost }}</td>
                                    <td>{{ $cartProduct->cart_qty }}</td>
                                    <td>{{ $partialTotal = $cartProduct->productC->cost * $cartProduct->cart_qty }}</td>
                                    <td>
                                        <a href="{{ route('reduceByOne', $cartProduct->productC->id) }}" class="btn btn-danger btn-sm">
                                            <i class="fas fa-minus"></i>
                                        </a>
                                        <a href="{{ route('addByOne', $cartProduct->productC->id) }}" class="btn btn-success btn-sm">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                        <a href="{{ route('cart.delete', $cartProduct->productC->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @php
                                    $cartTotal += $partialTotal; // Accumulate partial total to cart total
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <p>Total Cart Amount: {{ $cartTotal }}</p>

                    <!-- Payment Method Dropdown -->
                    <form action="{{ route('checkout') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="payment_method">Payment Method:</label>
                            <select name="payment_method" id="payment_method" class="form-control">
                                <option value="COD">Cash on Delivery</option>
                                <option value="E-Wallet">E-Wallet</option>
                                <option value="Online Banking">Online Banking</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Checkout</button>
                    </form>
            </div>
        </div>
    </div>
@endsection
