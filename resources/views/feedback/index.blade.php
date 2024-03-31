{{-- @extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h1>Feedback</h1>
    <div class="container">
        @foreach ($allFeedback as $item)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Comment: {{ $item->comments }}</h5>
                    @if ($item->img_path)
                        @php
                            $imagePaths = explode(',', $item->img_path);
                        @endphp
                        @foreach ($imagePaths as $imagePath)
                            <img src="{{ asset($imagePath) }}" alt="Feedback Image" class="img-fluid mb-3">
                        @endforeach
                    @endif
                    @if ($filteredFeedback->contains($item))
                    <form action="{{ route('review.delete', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('review.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection --}}

@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="container">
        @foreach ($sortedFeedback as $item)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">User: {{ $item->customer->username }}</h5>
                    <h5 class="card-title">Comment: {{ $item->comments }}</h5>
                    @if ($item->img_path)
                        @php
                            $imagePaths = explode(',', $item->img_path);
                        @endphp
                       @foreach ($imagePaths as $imagePath)
                            <img src="{{ asset($imagePath) }}" alt="Feedback Image" class="img-fluid mb-3" style="width: 60px; height: 60px;">
                       @endforeach
                    @endif
                    @if ($feedback->contains($item))
                    <form action="{{ route('feedback.delete', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('feedback.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
