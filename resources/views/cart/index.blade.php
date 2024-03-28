@extends('layouts.master')

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Cart</h1>
                @if(count($cartItems) > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Type</th>
                                <th>Cost</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $cartItem)
                                <tr>
                                    <td>{{ $cartItem->productC->name }}</td>
                                    <td>{{ $cartItem->productC->type }}</td>
                                    <td>{{ $cartItem->productC->cost }}</td>
                                    <td>{{ $cartItem->cart_qty }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('checkout') }}" class="btn btn-primary">Checkout</a>
                @else
                    <p>Your cart is empty.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
