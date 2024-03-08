@extends('layouts.app')

@section('body')
    <div class="container">
        <h1>Edit Form, gumamit nako laravelcollective/html dito, composer require laravelcollective/html</h1>
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
                        {{ Form::label('cost', 'Cost') }}
                        {{ Form::number('cost', null, ['class' => 'form-control', 'placeholder' => 'Enter product cost']) }}
                        @error('cost')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        {{ Form::label('img_path', 'Upload Image') }}
                        {!! Form::file('img_path', ['class' => 'form-control-file']) !!}
                        @error('img_path')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <img src="{{ url($product->img_path) }}" alt="product image" width="50" height="50">
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
