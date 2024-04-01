@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h1>Create Products</h1>
    <div class="container">
        <form action="{{ route('supplier.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Supplier Name: </label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email: </label>
                <input type="text" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="contact_number">Contact Number: </label>
                <input type="text" class="form-control" name="contact_number" required>
            </div>
            <div class="form-group">
                <label for="img_path">Supplier Images: </label>
                <input type="file" class="form-control-file" name="img_path[]" multiple required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection