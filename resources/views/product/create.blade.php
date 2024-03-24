{{-- @extends('layouts.app')
@section('body')
<div class="container mt-4">
    <h1>Create Products</h1>
    <div class="container">
        <form action="{{ route('product.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Product Name: </label>
                <input type="text" class="form-control" name="name" required>
            </div>

            {{-- Pwede to idropdown menu para less hassle //
            <div class="form-group">
                <label for="type">Product Type: </label>
                <input type="text" class="form-control" name="type" required>
            </div>
            <div class="form-group">
                <label for="cost">Cost: </label>
                <input type="text" class="form-control" name="cost" required>
            </div>
            <div class="form-group">
                <label for="img_path">Product Image: </label>
                <input type="file" class="form-control-file" name="img_path" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection --}}

@extends('layouts.base')
@section('content')
<div class="container mt-4">
    <h1>Create Products</h1>
    <div class="container">
        <form action="{{ route('product.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Product Name: </label>
                <input type="text" class="form-control" name="name" required>
            </div>

            {{-- Pwede to idropdown menu para less hassle --}}
            <div class="form-group">
                <label for="type">Product Type: </label>
                <input type="text" class="form-control" name="type" required>
            </div>
            <div class="form-group">
                <label for="cost">Cost: </label>
                <input type="text" class="form-control" name="cost" required>
            </div>
            <div class="form-group">
                <label for="stock">Stock Quantity: </label>
                <p>How many stock will be added on the inventory</p>
                <input type="number" class="form-control" name="stock" required>
            </div>
            <div class="form-group">
                <label for="img_path">Product Images: </label>
                <input type="file" class="form-control-file" name="img_path[]" multiple required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
