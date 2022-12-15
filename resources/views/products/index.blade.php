@php
    $status = \App\Models\Products::getStatus()
        ->sortBy('val')
        ->pluck('status');
@endphp
@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                {{ trans('cruds.product.title') }}
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <label for="">{{ trans('cruds.product.fields.name') }}</label>
                    <input type="text" class="form-control" placeholder="{{ trans('cruds.product.fields.name') }}"
                        id="fName">
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="">{{ trans('cruds.product.fields.status') }}</label>
                        <select class="form-select" name="" id="fStatus">
                            @foreach ($status as $key => $value)
                                <option value="{{ $key }}"> {{ $value }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row justify-content-center align-items-center g-2">
                        <div class="col-md-5">
                            <label for="">{{ trans('cruds.product.fields.price_from') }}</label>
                            <input type="text" class="form-control" id='fPriceFrom'>
                        </div>
                        <div class="col-md-1" style="text-align: center;">
                            <label for=""></label>
                            <span for=""><b class="d-flex align-items-center">~</b></span>
                        </div>
                        <div class="col-md-5">
                            <label for="">{{ trans('cruds.product.fields.price_to') }}</label>
                            <input type="text" class="form-control" id='fPriceTo'>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center align-items-center g-2 mt-1 mb-2">
                <div class="col-md-9">
                    <a class="btn btn-sm btn-success" href="{{ route('products.create') }}"> {{ trans('global.add') }} </a>
                </div>
                <div class="col-md-3">
                    <a name="" id="btnSearch" class="btn btn-sm btn-primary mr-5" href="#" role="button">
                        <i class="fa fa-search" aria-hidden="true"></i>
                        {{ trans('global.search') }}
                    </a>
                    <a name="" id="btnSerachClear" class="btn btn-sm btn-success" href="#" role="button">
                        <i class="fa fa-times" aria-hidden="true"></i>
                        {{ trans('global.search_clear') }}
                    </a>
                </div>
            </div>

            <div class="row justify-content-center align-items-center g-2">
                {!! $dataTable->table() !!}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
<script type="text/javascript">
$(function() {

    var table = $('#dataTableBuilder').DataTable();
 
    $('#btnSearch').on('click', function ($e) {
        var name = $('#fName').val();
        var status = $('#fStatus').val();
        var price_from = $('#fPriceFrom').val();
        var price_to = $('#fPriceTo').val();
        var keyword  = name + ' ' + price_from + ' ' + price_to
            var val = $.fn.dataTable.util.escapeRegex(keyword);
        
            console.log(keyword);
            console.log(val);
       
        table.search(val, true).draw();
        // table.search( keyword ).draw();
        
    });


});      
</script>
@endpush
