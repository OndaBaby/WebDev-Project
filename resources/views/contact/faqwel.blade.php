@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Frequently Asked Questions</h2>
    <div id="accordion">
        @foreach($faqs as $faq)
        <div class="card">
            <div class="card-header" id="heading{{ $faq->id }}">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{ $faq->id }}" aria-expanded="true" aria-controls="collapse{{ $faq->id }}">
                        Q: {{ $faq->question }}
                    </button>
                </h5>
            </div>
            <div id="collapse{{ $faq->id }}" class="collapse" aria-labelledby="heading{{ $faq->id }}" data-parent="#accordion">
                <div class="card-body">
                    <p>A: {{ $faq->answer }}</p>
                    @if($faq->img_path)
                    @php
                    $imagePaths = explode(',', $faq->img_path);
                    @endphp
                    @foreach($imagePaths as $imagePath)
                    <img src="{{ asset(str_replace('public/', '', $imagePath)) }}" alt="FAQ Image" style="max-width: 200px;">
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
