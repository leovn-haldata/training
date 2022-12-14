@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center p-lg-5">
        <div class="col-md-6">
            <div class="card card-outline card-dark">
                <div class="card-header">
                    <div class="card-title">
                        {{ trans('global.login') }}
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-12 input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="{{ trans('global.email') }}">
                                @error('email')
                                <div class=" text-sm text-red-600" role="alert">{{ $errors->first('email') }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="current-password" placeholder="{{ trans('global.password') }}">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ trans('global.remember_me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('global.login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ trans('global.forgot_password') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="row mb-3">
                        <div class="col-md-12 offset-md-4">
                            <a class="btn btn-link" href="{{ route('register') }}">
                                {{ trans('global.register') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
