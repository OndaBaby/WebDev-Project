@extends('layouts.app')

@section('content')
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="container">
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartProducts as $cartProduct)
                                <tr>
                                    <td>{{ $cartProduct->productC->name }}</td>
                                    <td>{{ $cartProduct->productC->type }}</td>
                                    <td>{{ $cartProduct->productC->cost }}</td>
                                    <td>{{ $cartProduct->cart_qty }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('checkout') }}" class="btn btn-primary">Checkout</a>
            </div>
        </div>
    </div>
@endsection

{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Cart</h1>
                <form action="{{ route('update.cart') }}" method="post">
                    @csrf
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
                                    <td>
                                        <div class="input-group">
                                            <button class="btn btn-outline-secondary minus-btn" type="button" data-cart-id="{{ $cartProduct->id }}">-</button>
                                            <input type="number" class="form-control quantity-input" name="quantity[{{ $cartProduct->id }}]" value="{{ $cartProduct->cart_qty }}" readonly>
                                            <button class="btn btn-outline-secondary plus-btn" type="button" data-cart-id="{{ $cartProduct->id }}">+</button>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger delete-btn" type="button" data-cart-id="{{ $cartProduct->id }}">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('checkout') }}" class="btn btn-primary">Checkout</a>
                </form>
            </div>
        </div>
    </div>
@endsection --}}

{{-- @section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to handle incrementing quantity
        document.querySelectorAll('.plus-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                var cartId = this.dataset.cartId;
                var quantityInput = document.querySelector('input[name="quantity[' + cartId + ']"]');
                var currentQuantity = parseInt(quantityInput.value);
                quantityInput.value = currentQuantity + 1; // Increment quantity in UI
                // Automatically update the cart quantity in the database
                updateCartQuantity(cartId, quantityInput.value);
            });
        });

        // Function to handle decrementing quantity
        document.querySelectorAll('.minus-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                var cartId = this.dataset.cartId;
                var quantityInput = document.querySelector('input[name="quantity[' + cartId + ']"]');
                var currentQuantity = parseInt(quantityInput.value);
                if (currentQuantity > 1) {
                    quantityInput.value = currentQuantity - 1; // Decrement quantity in UI
                    // Automatically update the cart quantity in the database
                    updateCartQuantity(cartId, quantityInput.value);
                }
            });
        });

        // Function to update cart quantity in the database
        function updateCartQuantity(cartId, quantity) {
            var formData = new FormData();
            formData.append('cart_id', cartId);
            formData.append('quantity', quantity);
            // Send the request to update the cart quantity
            fetch("{{ route('update.cart') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (response.ok) {
                    console.log('Cart quantity updated successfully');
                } else {
                    console.error('Failed to update cart quantity');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        // Function to handle deleting a cart item
        document.querySelectorAll('.delete-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                var cartId = this.dataset.cartId;
                // Perform deletion action if needed
            });
        });
    });
</script>
@endsection --}}
