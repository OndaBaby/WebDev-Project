@extends('layouts.app')
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
                            @if ($order->status === 'Pending')
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
@endsection
