@extends('layouts.base')
@section('content')
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="card">
            <div class="card-header bg-orange text-black">Manage FAQs</div>
            <div class="card-body">
                <a class="btn btn-primary mb-3" href="{{ route('faqs.create') }}">Add FAQs</a>
                <div class="table-responsive">
                    {{ $dataTable->table(['class' => 'table table-bordered table-striped']) }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .bg-orange {
            background-color: orange !important;
        }
        .dataTable {
            width: 100% !important;
        }
        .dataTable thead th {
            background-color: #343a40;
            color: #fff;
            border-color: #454d55;
        }
        .dataTable tbody td {
            border-color: #454d55;
        }
        .dataTable tbody tr:nth-child(odd) {
            background-color: #f8f9fa;
        }
        .dataTable_wrapper .dataTables_paginate .paginate_button {
            border: 1px solid #454d55;
            color: #454d55;
            margin-left: 2px;
        }
        .dataTable_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #454d55;
            color: #fff;
        }
    </style>
@endpush

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
