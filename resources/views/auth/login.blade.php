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

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Logowanie') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('auth.login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Hasło') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Zapamiętaj mnie') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary-blue">
                                    {{ __('Zaloguj') }}
                                </button>

                                @if (Route::has('auth.password.reset'))
                                    <a class="btn btn-link" href="{{ route('auth.password.reset') }}">
                                        {{ __('Zapomniałeś hasła?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
