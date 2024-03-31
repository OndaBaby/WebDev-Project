@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create FAQ</h2>
        <form action="{{ route('faqs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" class="form-control" id="category" name="category" required>
            </div>
            <div class="form-group">
                <label for="question">Question:</label>
                <input type="text" class="form-control" id="question" name="question" required>
            </div>
            <div class="form-group">
                <label for="answer">Answer:</label>
                <textarea class="form-control" id="answer" name="answer" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="img_path">Product Images: </label>
                <input type="file" class="form-control-file" name="img_path[]" multiple required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
