@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit FAQ</h2>
        <form action="{{ route('faqs.update', $faq->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" class="form-control" id="category" name="category" value="{{ $faq->category }}" required>
            </div>
            <div class="form-group">
                <label for="question">Question:</label>
                <input type="text" class="form-control" id="question" name="question" value="{{ $faq->question }}" required>
            </div>
            <div class="form-group">
                <label for="answer">Answer:</label>
                <textarea class="form-control" id="answer" name="answer" rows="5" required>{{ $faq->answer }}</textarea>
            </div>
            <div class="form-group">
                <label for="img_path">Image: </label>
                <input type="file" class="form-control-file" name="img_path[]" multiple>
            </div>
            @if(!empty($faq->img_path))
            @php
                $imagePaths = explode(',', $faq->img_path);
            @endphp
            @foreach($imagePaths as $image)
                <img src="{{ url($image) }}" alt="current image" width="50" height="50">
            @endforeach
            @endif
            <p>     </p>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
