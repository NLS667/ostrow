@extends('layouts.front')

@section('content')
<div class="wrapper wrapper-full-page">
    <div class="page-header login-page header-filter" filter-color="black" style="background-image: url('/img/login.jpg'); background-size: cover; background-position: top center;align-items: center;" data-color="purple">
        <div class="container" style="height: auto;">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
                    {{ Form::open(['route' => 'frontend.auth.login', 'class' => 'form']) }}
                    <div class="card card-login card-hidden mb-3">
                        <div class="card-header card-header-primary text-center">
                            <h4 class="card-title"><strong>{{ config('app.name') }}</strong></h4>
                        </div>
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
                                    <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Zapamiętaj mnie
                                        <span class="form-check-sign"><span class="check"></span></span>
                                </label>
                            </div>
                        </div>
                        <div class="card-footer justify-content-center">
                            {{ Form::submit('Zaloguj', ['class' => 'btn btn-primary btn-link btn-lg']) }}
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
        <footer class="footer">
            <div class="container">
                <div class="copyright float-right">
                    © 2022, wykonano z <i class="material-icons">favorite</i> przez <a href="https://radspzoo.pl" target="_blank">RAD</a>
                </div>
            </div>            
        </footer>
    </div>
</div>
@endsection