@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <a class="btn btn-success" href="{{ route('products.create') }}"> {{ trans('global.add') }} </a>
        </div>
        <div class="card-body">
            {!! $dataTable->table() !!}

        </div>
    </div>
@endsection

@push('scripts')

    {!! $dataTable->scripts() !!}

@endpush
