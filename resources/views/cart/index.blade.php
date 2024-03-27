{{-- @extends('layouts.master')
@section('body')
    <div class="container">
        <h1>Cart</h1>
        @if ($cartItems->isEmpty())
            <p>Your cart is empty.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $cartItem)
                        <tr>
                            <td>{{ $cartItem->productC->name }}</td>
                            <td>
                                <form action="{{ route('cart.update', $cartItem->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" name="action" value="decrement" class="btn btn-sm btn-secondary">-</button>
                                    {{ $cartItem->cart_qty }}
                                    <button type="submit" name="action" value="increment" class="btn btn-sm btn-secondary">+</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('cart.destroy', $cartItem->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection --}}

<!-- resources/views/cart.blade.php -->

<!-- resources/views/cart.blade.php -->

@extends('layouts.master')

@section('body')
    <div class="container">
        <h1>Cart</h1>
        @if ($cartItems->isEmpty())
            <p>Your cart is empty.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $cartItem)
                        <tr>
                            <td>
                                @if ($cartItem->productC)
                                    {{ $cartItem->productC->name }}
                                @else
                                    Product Not Found
                                @endif
                            </td>
                            <td>
                                {{-- <form action="{{ route('cart.update', ['id' => $cartItem->id]) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" name="action" value="decrement" class="btn btn-sm btn-secondary">-</button>
                                    {{ $cartItem->cart_qty }}
                                    <button type="submit" name="action" value="increment" class="btn btn-sm btn-secondary">+</button>
                                </form> --}}
                            </td>
                            <td>
                                {{-- <form action="{{ route('cart.destroy', $cartItem->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                                </form> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
