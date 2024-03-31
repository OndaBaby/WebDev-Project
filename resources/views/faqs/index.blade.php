@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <h2>FAQs</h2>
        <div class="mb-3">
            <a href="{{ route('faqs.create') }}" class="btn btn-primary">Add New</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($faqs as $faq)
                <tr>
                    <td>{{ $faq->id }}</td>
                    <td>{{ $faq->category }}</td>
                    <td>{{ $faq->question }}</td>
                    <td>{{ $faq->answer }}</td>
                    <td>
                        @if($faq->img_path)
                            @php
                                $imagePaths = explode(',', $faq->img_path);
                            @endphp
                            @foreach($imagePaths as $imagePath)
                                <img src="{{ url($imagePath) }}" alt="Faq Image" class="d-block w-100 product-image" style="width: 60px; height: 60px;">
                            @endforeach
                        @else
                            No Image
                        @endif
                    </td>
                    <td>
                        @if($faq->deleted_at == null)
                        <a href="{{ route('faqs.edit', $faq->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('faqs.destroy', $faq->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        @else
                            <a href="{{ route('faqs.edit', $faq->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('faqs.restore', $faq->id) }}" method="POST" style="display:inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Restore</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
