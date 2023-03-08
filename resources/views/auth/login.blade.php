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
                        <label for="email">{{ trans('labels.frontend.auth.register-user.email') }}</label>
                            <div class="input-group form-group-no-border{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="nc-icon nc-email-85"></i>
                                    </span>
                                </div>
                                <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ trans('labels.frontend.auth.register-user.email') }}" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="password">{{ trans('labels.frontend.auth.register-user.password') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend form-group-no-border">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-key-25"></i>
                                        </span>
                                    </div>
                                </div>
                                <input id="password" type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ trans('labels.frontend.auth.register-user.password') }}" value="{{ !$errors->has('password') ? 'secret' : '' }}" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input @error('remember') is-invalid @enderror" type="checkbox" name="remember">
                                        <span class="form-check-sign"></span>
                                        <small>{{ trans('labels.frontend.auth.remember_me') }}</small> 
                                </label>
                            </div>
                            {{ Form::submit(trans('labels.frontend.auth.login_button'), ['class' => 'btn btn-primary-blue btn-block btn-round']) }}
                            {{ Form::close() }}
                            <div class="forgot">
                                {{ link_to_route('frontend.auth.password.request', trans('labels.frontend.passwords.forgot_password'), [], ['class' => 'btn btn-link btn-primary-blue']) }}
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