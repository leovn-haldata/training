@php
    
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
                {{-- {!! $dataTable->table() !!} --}}
                <table class="table table-striped yajra-datatable" style="padding-top:10px;">
                    <thead class="">
                        <tr>
                            <th></th>
                            <th>{{ trans('cruds.product.fields.name') }}</th>
                            <th>{{ trans('cruds.product.fields.description') }}</th>
                            <th>{{ trans('cruds.product.fields.price') }}</th>
                            <th>{{ trans('cruds.product.fields.status') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- {!! $dataTable->scripts() !!} --}}
    <script type="text/javascript">
        $(function() {
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('products.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'product_name',
                        name: 'product_name'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'product_price',
                        name: 'product_price'
                    },
                    {
                        data: 'is_sales',
                        name: 'is_sales'
                    },
                    // {
                    //     data: 'action',
                    //     name: 'action',
                    //     orderable: true,
                    //     searchable: true
                    // },
                ],
                columnDefs: [
                    {
                        targets: [0, 2,4], 
                        searchable: false
                    }
                ],
                search: {
                    regex: true
                },
                success: function (response) {
                       console.log(response);
                }
            });

            $('#btnSearch').on('click', function() {
                var name = $('#fName').val();
                var status = parseInt($('#fStatus').val(), 10);
                var price_from = $('#fPriceFrom').val();
                var price_to = $('#fPriceTo').val();
                var keyword = name + ' ' + status + ' ' + price_from + ' ' + price_to

                // table.search(keyword).draw();
                $.ajax({
                    type: "get",
                    url: "{{ route('products.index') }}",
                    data: 'product_name=' + keyword,
                    // dataType: "dataType",
                    success: function (response) {
                        // console.log(response);
                        var table = $('.yajra-datatable').DataTable();
                        table.draw();
                        // table.search(keyword).draw();
                    }
                });
                table.draw();

            });

        });
   
    </script>
    <script type="text/javascript">
        $(function() {





            // $('#btnSearch').on('click', function () {
            //     var table = $('#dataTableBuilder').DataTable({
            //     search: {
            //     regex: true,
            //     searching: false
            //   }
            // });
            //     var name = $('#fName').val();
            //     var status = parseInt($('#fStatus').val(), 10);
            //     var price_from = $('#fPriceFrom').val();
            //     var price_to = $('#fPriceTo').val();
            //     var keyword  = name + ' ' + status + ' ' + price_from + ' ' + price_to

            //         // var val = $.fn.dataTable.util.escapeRegex(keyword);

            //     console.log(keyword);
            //     var data = table
            //         .column( 2 )
            //         .search(keyword)
            //         .data();

            //     data.push( 'Fini' );
            // table.columns([2,4]).search([keyword, status]).draw();
            // table.search( keyword ).draw();

            // });

            // $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
            //     var min = parseInt($('#min').val(), 10);
            //     var max = parseInt($('#max').val(), 10);
            //     var age = parseFloat(data[3]) || 0; // use data for the age column

            //     if (
            //         (isNaN(min) && isNaN(max)) ||
            //         (isNaN(min) && age <= max) ||
            //         (min <= age && isNaN(max)) ||
            //         (min <= age && age <= max)
            //     ) {
            //         return true;
            //     }
            //     return false;
            // });

            // $(document).ready(function () {
            //     var table = $('#example').DataTable();

            //     // Event listener to the two range filtering inputs to redraw on input
            //     $('#min, #max').keyup(function () {
            //         table.draw();
            //     });
            // });

            // console.log(table.draw);

        });
    </script>
@endpush
