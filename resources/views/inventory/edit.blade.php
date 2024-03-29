{{-- @extends('layouts.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Inventory</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('inventory.update', $inventory->product_id) }}">
                        @csrf
                        <div class="form-group row">
                            <label for="stock" class="col-md-4 col-form-label text-md-right">Stock</label>

                            <div class="col-md-6">
                                <input id="stock" type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ $inventory->stock }}" required autocomplete="stock" autofocus>

                                @error('stock')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Stock
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Edit Inventory</h1>
        <div class="card">
            <div class="card-body">
                {!! Form::model($inventory, ['route' => ['inventory.update', $inventory->product_id], 'class' => 'form', 'method' => 'post']) !!}
                    <div class="form-group">
                        {{ Form::label('stock', 'Stock') }}
                        {{ Form::text('stock', null, ['class' => 'form-control', 'placeholder' => 'Enter stock']) }}
                        @error('stock')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Update Stock', ['class' => 'btn btn-primary']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
