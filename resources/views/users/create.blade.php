@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">

            <div class="card-header">
                {{ trans('global.create') }} {{ trans('cruds.user.title_singular') }}
            </div>
        
            <div class="card-body">
                <form method="POST" action="{{ route("users.store") }}" enctype="multipart/form-data" >
                    @csrf
                    <input type="hidden" name="is_delete" value="0">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="name">{{ trans('cruds.user.fields.name') }}</label>
                        <div class="col-md-10">
                            <input class=" form-control 
                            {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                            type="text" name="name" id="name" 
                            value="{{ old('name', '') }}" >
                            @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                        <div class="col-md-10">
                            <input class="form-control 
                            {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                            type="email" name="email" id="email" 
                            value="{{ old('email' , '') }}" >
                            @if($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                        <div class="col-md-10">
                            <input class="form-control 
                            {{ $errors->has('password') ? 'is-invalid' : '' }}" 
                            type="password" name="password" id="password" 
                            value="{{ old('password', '') }}">
                            @if($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label required" for="password_confirmation">{{ trans('global.password_confim') }}</label>
                        <div class="col-md-10">
                            <input class="form-control 
                            {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" 
                            type="password" name="password_confirmation" id="password_confirmation" 
                            value="{{ old('password_confirmation', '') }}">
                            @if($errors->has('password_confirmation'))
                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label required" for="roles">{{ trans('global.group') }}</label>
                        <div class="col-md-10">
                            <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="group_role" id="roles">
                                @foreach($roles as $id => $role)
                                    <option value="{{ $id }}" {{  old('role', ($id == 2)) ? 'selected' : '' }}>{{ $role }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('roles'))
                                <span class="text-danger">{{ $errors->first('roles') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
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
                            <a class="btn btn-lg btn-outline-dark" href="{{ route('users.index') }}">
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
</div>




@endsection