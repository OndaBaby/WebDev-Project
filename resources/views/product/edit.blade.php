{{-- @extends('layouts.app')
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
@endsection --}}


@extends('layouts.app')
@section('content')
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #267df0; /* Shopee blue */
        }

        .btn-primary {
            background-color: #267df0; /* Shopee blue */
            color: #fff;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #1e62d0; /* Darker shade of Shopee blue */
        }

        body {
        background-image: url('{{ asset('storage/images/orange.png') }}');
        background-size: cover;
    }
    </style>
    <div class="container">
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
                        <p></p>
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
