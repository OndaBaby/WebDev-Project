@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h1>Edit Feedback</h1>
    <div class="container">
        <form action="{{ route('feedback.update', $feedback->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="comment">Comment: </label>
                <input type="text" class="form-control" name="comments" value="{{ $feedback->comments }}" required>
            </div>
            <div class="form-group">
                <label for="img_path">Image: </label>
                <input type="file" class="form-control-file" name="img_path[]" multiple>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
