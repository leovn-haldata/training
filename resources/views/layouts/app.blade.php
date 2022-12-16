<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
        <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.css"/>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.3/css/buttons.bootstrap5.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchbuilder/1.4.0/css/searchBuilder.bootstrap5.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchpanes/2.1.0/css/searchPanes.bootstrap5.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/staterestore/1.2.0/css/stateRestore.bootstrap5.css"/>
     

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>


</head>
<body>
    <div id="app">
        @include('layouts.nav')

        <main class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>

    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.js"></script>


    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.3/js/dataTables.buttons.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.bootstrap5.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/searchbuilder/1.4.0/js/dataTables.searchBuilder.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/searchbuilder/1.4.0/js/searchBuilder.bootstrap5.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/searchpanes/2.1.0/js/dataTables.searchPanes.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/searchpanes/2.1.0/js/searchPanes.bootstrap5.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/staterestore/1.2.0/js/dataTables.stateRestore.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/staterestore/1.2.0/js/stateRestore.bootstrap5.js"></script>
    
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script>
        $(function() {
  
 
  let tb  = "<'row'<'col-md-12'>rf>" 
      tb += "<'row'<'col-md-5 offset-md-4'p><'col-md-3'i>>" 
      tb += "<'row'<'col-sm-12 col-md-12't>>"
      tb += "<'row'<'offset-md-4 col-md-8 'p>>"
  $.extend(true, $.fn.dataTable.defaults, {
    language: {
        "sProcessing":   '<div class="spinner processing">' + "Đang xử lý..." + '</div>',
        "sLengthMenu":   "Xem _MENU_ mục",
        "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
        "sInfo":         "Hiển thị _START_ ~ _END_ trong tổng số _TOTAL_ mục",
        "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
        "sInfoFiltered": "(được lọc từ _MAX_ mục)",
        "sInfoPostFix":  "",
        "sSearch":       "Tìm:",
        "sUrl":          "",
        "oPaginate": {
            "sFirst":    "Đầu",
            "sPrevious": "Trước",
            "sNext":     "Tiếp",
            "sLast":     "Cuối"
        }
    },
    dom: tb,
});
 
});
    </script>
    <style>
        .table > thead {
            color: white;
            background-color: red
        }
        #dataTableBuilder_paginate, 
        .dataTables_wrapper .dataTables_paginate {
            float: left;
        }
        .paging {

        }
        .tbinfo {
            text-align: left
        }
        #dataTableBuilder_processing {
            z-index: 999;
            background-color: none;
            color: red;
            margin-bottom: 0;
            text-transform: uppercase;
            
        }
        .dataTables_processing .card {
            box-shadow: none !important
        }
        .dataTables_wrapper .dataTables_processing {
            position: absolute;
            top: 0% !important;
            left: 50%;
            width: 100%;
            height: 40px;
            margin-left: -50%;
            margin-top: -25px;
            padding-top: 20px;
            text-align: center;
            font-size: 1.2em;
        }
    </style>
    @stack('scripts')

</body>
</html>
