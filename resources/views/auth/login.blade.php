@extends('frontend.layouts.app')

@section('content')
<div class="wrapper">
    <div class="page-header" style="background-image: url('/img/login.jpg'), linear-gradient(104.36deg, #00264c 60%, #0054A6 90%);">
        <div class="filter"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4 col-sm-6 offset-sm-3">                    
                    <div class="card card-register">
                        <h3 class="card-title">{{ trans('labels.frontend.auth.login_box_title') }}</h3>
                        {{ Form::open(['route' => 'frontend.auth.login', 'class' => 'register-form']) }}
                        <div class="card-body">
                            <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">email</i>
                                        </span>
                                    </div>
                                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                                </div>
                                @if ($errors->has('email'))
                                <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                                @endif
                            </div>
                            <div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">lock_outline</i>
                                        </span>
                                    </div>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Hasło" value="{{ !$errors->has('password') ? 'secret' : '' }}" required>
                                </div>
                                @if ($errors->has('password'))
                                <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                                @endif
                            </div>
                            <div class="form-check mr-auto ml-3 mt-3">
                                <label class="form-check-label">
                                    <input class="form-check-input @error('remember') is-invalid @enderror" type="checkbox" name="remember">
                                        <span class="form-check-sign"></span>
                                        <small>{{ trans('labels.frontend.auth.remember_me') }}</small> 
                                </label>
                            </div>
                        </div>
                        <div class="card-footer justify-content-center">
                            {{ Form::submit(trans('labels.frontend.auth.login_button'), ['class' => 'btn btn-primary-blue btn-block btn-round']) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                    <div class="row">
                        <div class="col-6">
                            @if (Route::has('auth.password.reset'))
                                <a href="{{ route('auth.password.reset') }}" class="text-light">
                                    <small>Nie pamiętam hasła</small>
                                </a>
                            @endif
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
        <div class="footer register-footer text-center">
            <h6>{!! trans('strings.frontend.copyright') !!}</h6>
        </div>
    </div>
</div>
@endsection