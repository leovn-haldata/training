@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.customer.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("customers.update", [$customer->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group row">
                <label class="col-md-2 col-form-label" for="customer_name">{{ trans('cruds.customer.fields.full_name') }}</label>
                <div class="col-md-10">
                    <input class="form-control {{ $errors->has('customer_name') ? 'is-invalid' : '' }}" type="text" name="customer_name" id="name" value="{{ old('name', $customer->customer_name) }}" required>
                    @if($errors->has('customer_name'))
                        <span class="text-danger">{{ $errors->first('customer_name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.full_name_helper') }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label" for="email">{{ trans('cruds.customer.fields.email') }}</label>
                <div class="col-md-10">
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', $customer->email) }}" >
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.email_helper') }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label" for="tel_num">{{ trans('cruds.customer.fields.phone') }}</label>
                <div class="col-md-10">
                    <input class="form-control {{ $errors->has('tel_num') ? 'is-invalid' : '' }}" type="text" name="tel_num" id="tel_num" value="{{ old('tel_num', $customer->tel_num) }}" >
                    @if($errors->has('tel_num'))
                        <span class="text-danger">{{ $errors->first('tel_num') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.phone_helper') }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label" for="address">{{ trans('cruds.customer.fields.address') }}</label>
                <div class="col-md-10">
                    <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $customer->address) }}" >
                    @if($errors->has('address'))
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.address_helper') }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label required" for="roles">{{ trans('global.status') }}</label>
                <div class="col-md-10">
                    <label >TRUE</label>
                </div>
                <input class="form-control" type="hidden" name="is_active" value="1">

            </div>
          
            
            <div class="form-group row">
                <div class="col-md-2 offset-md-8">
                    <a class="btn btn-lg btn-outline-dark" href="{{ route('customers.index') }}">
                        {{ trans('global.cancel') }}
                    </a>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-lg btn-danger order-last" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
                
            </div>
        </form>
    </div>
</div>
</div>



@endsection