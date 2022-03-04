@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="page-header">
        <div class="filter"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4 col-sm-6 offset-sm-3">
                    <div class="card card-register">
                        <h3 class="card-title">CRM Login</h3>
                        {{ Form::open(['route' => 'auth.login', 'class' => 'register-form']) }}
                        <label for="email">E-mail</label>
                        <div class="input-group form-group-no-border">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="nc-icon nc-email-85"></i>
                                </span>
                            </div> 
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="e-mail">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <label for="password">Hasło</label>
                        <div class="input-group form-group-no-border">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="nc-icon nc-key-25"></i>
                                </span>
                            </div>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="new-password" placeholder="hasło">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">                                
                                <input id="remember" type="checkbox" class="form-check-input @error('remember') is-invalid @enderror" name="remember" value="0">
                                <span class="form-check-sign"></span>
                                <small>Zapamiętaj mnie</small>                                
                            </label>
                        </div>
                        
                        {{ Form::submit('Zaloguj', ['class' => 'btn btn-primary-blue btn-block btn-round']) }}
                        {{ Form::close() }}
                        <div class="forgot">
                            {{ link_to_route('auth.password.reset', 'Nie pamiętam hasła', [], ['class' => 'btn btn-link btn-primary-blue']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer register-footer text-center">
            <h6>© 2021, made with <i class="fa fa-heart heart"></i> by RAD</h6>
        </div>
    </div>
</div>
@endsection