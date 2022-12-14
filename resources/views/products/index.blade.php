@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-success" href="{{ route('products.create') }}"> {{ trans('global.add') }} </a>
        </div>
        <div class="card-body">
            <input type="text" name="name" class="form-control searchEmail" placeholder="Search for Email Only...">

            {!! $dataTable->table() !!}

        </div>
    </div>
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
    <script type="text/javascript">
        $(function () {
         
          var table = $('#datatable-id').DataTable({
              processing: true,
              serverSide: true,
              ajax: {
                url: "{{ route('products.index') }}",
                data: function (d) {
                      d.name = $('.searchEmail').val(),
                      d.search = $('input[type="search"]').val()
                  }
              }
              
          });
         
          $(".searchname").keyup(function(){
              table.draw();
          });
        
        });
      </script>
@endpush
