@extends('layouts.base')
@section('content')
    <div class="container">
        <h1>Edit Form</h1>
        <div class="card">
            <div class="card-body">
                {!! Form::model($product, ['route' => ['product.update', $product->id], 'class' => 'form', 'files' => true, 'method' => 'post']) !!}
                    <div class="form-group">
                        {{ Form::label('name', 'Name') }}
                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter product name']) }}
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        {{ Form::label('type', 'Type') }}
                        {{ Form::text('type', null, ['class' => 'form-control', 'placeholder' => 'Enter product type']) }}
                        @error('type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        {{ Form::label('description', 'Description') }}
                        {{ Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Enter product description']) }}
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        {{ Form::label('cost', 'Cost') }}
                        {{ Form::number('cost', null, ['class' => 'form-control', 'placeholder' => 'Enter product cost']) }}
                        @error('cost')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        {{ Form::label('img_path[]', 'Upload Images') }}
                        {!! Form::file('img_path[]', ['class' => 'form-control-file', 'multiple' => true]) !!}
                        @error('img_path')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        @if(!empty($product->img_path))
                            @php
                                $imagePaths = explode(',', $product->img_path);
                            @endphp
                            @foreach($imagePaths as $image)
                                <img src="{{ url($image) }}" alt="product image" width="50" height="50">
                            @endforeach
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
