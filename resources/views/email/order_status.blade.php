{{-- @extends('layouts.master')
@section('body')
    <img src="{{ asset('storage/images/LogoE.png') }}" alt="ElectroKits Logo">ElektroKits
    <p>Order Status</p>

    <h2>{{ $orderTotal }}</h2>
@endsection --}}



{{-- lalagyan ko pa ng condition kapag shipped magnonotif lang na shipped na order nya, kapag delivered na ipapakita yung orderdetails and total --}}
@extends('layouts.master')
@section('body')
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f8f9fa; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <h2 style="text-align: center; font-size: 24px; margin-bottom: 20px; color: #343a40;">Order Status</h2>
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="{{ asset('storage/images/LogoE.png') }}" alt="ElectroKits Logo" style="max-width: 150px;"><br>
        </div>
        <p style="font-size: 16px; text-align: center; margin-bottom: 20px; color: #6c757d;">Thank you for your order with ElektroKits!</p>
        <hr style="border-color: #dee2e6; margin-bottom: 20px;">
        <h3 style="font-size: 20px; margin-bottom: 10px; color: #343a40;">Order Details:</h3>
        <ul style="list-style: none; padding-left: 0;">
            @foreach ($order as $item)
                <li style="margin-bottom: 10px; border: 1px solid #dee2e6; border-radius: 5px; padding: 10px;">
                    <strong>Status:</strong> {{  $item->status }}<br>
                    <strong>Product:</strong> {{ $item->name }}<br>
                    <strong>Quantity:</strong> {{ $item->qty }}<br>
                    <strong>Price:</strong> ₱{{ number_format($item->cost, 2) }}<br>
                </li>
            @endforeach
        </ul>
        <hr style="border-color: #dee2e6; margin-top: 20px; margin-bottom: 20px;">
        <p style="font-size: 18px; text-align: right; color: #343a40;"><strong>Total:</strong> ₱{{ number_format($totalOrder, 2) }}</p>
    </div>
@endsection
