@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center p-lg-5">
        <div class="col-md-6">
            <div class="card card-outline card-dark">
                <div class="card-header">
                    <div class="card-title">
                        {{ trans('global.register') }}
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" id="register">
                        @csrf
                        <input type="hidden" name="is_active" value="1">
                        <div class="row mb-3">
                            <div class="col-md-12 input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-id-card"></i></span>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus placeholder="{{ trans('global.name') }}">

                                @if ($errors->has('name'))
                                    <div class=" text-sm text-red-600" role="alert">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12 input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" placeholder="{{ trans('global.email') }}">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12 input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" placeholder="{{ trans('global.password') }}">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12 input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                                <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"  autocomplete="new-password" placeholder="{{ trans('global.password_confim') }}">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('global.register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="row mb-3">
                        <div class="col-md-12 offset-md-4">

                            <a class="btn btn-link" href="{{ route('login') }}">
                                {{ trans('global.login') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

