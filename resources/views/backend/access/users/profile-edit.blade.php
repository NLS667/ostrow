@extends ('backend.layouts.app', ['activePage' => 'profile-edit', 'titlePage' => 'Moje Konto'])

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-icon card-header-info">
                    <div class="card-icon">
                        <i class="material-icons">perm_identity</i>
                    </div>
                    <h4 class="card-title">Edycja Profilu</h4>
                </div>
                <div class="card-body">
                    {{ Form::model($logged_in_user, ['route' => 'admin.profile.update', 'class' => 'form-horizontal', 'method' => 'PATCH']) }}
                    <div class="row">
                        {{ Form::label('first_name', 'Imię', ['class' => 'col-sm-2 col-form-label']) }}
                        <div class="col-sm-7">
                            <div class="form-group bmd-form-group is-filled">
                                {{ Form::input('text', 'first_name', null, ['class' => 'form-control', 'placeholder' => 'Imię']) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{ Form::label('last_name', 'Nazwisko', ['class' => 'col-lg-2 col-form-label']) }}
                        <div class="col-sm-7">
                            <div class="form-group bmd-form-group is-filled">
                                {{ Form::input('text', 'last_name', null, ['class' => 'form-control', 'placeholder' => 'Nazwisko']) }}
                            </div>
                        </div>
                    </div>
                    {{ Form::submit('Aktualizuj Profil', ['class' => 'btn btn-rose pull-right', 'id' => 'update-profile']) }}
                    {{ Form::close() }}
                </div>
            </div>
            <div class="card">
                <div class="card-header card-header-icon card-header-info">
                    <div class="card-icon">
                        <i class="material-icons">lock</i>
                    </div>
                    <h4 class="card-title">Zmień hasło</h4>
                </div>
                <div class="card-body">
                    {{ Form::open(['route' => ['admin.access.user.change-password', $logged_in_user], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'patch']) }}
                    <div class="row">
                        {{ Form::label('old password', 'Stare hasło', ['class' => 'col-lg-2 col-form-label required', 'placeholder' => 'Stare Hasło']) }}
                        <div class="col-sm-7">
                            <div class="form-group bmd-form-group">
                                {{ Form::password('old_password', ['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{ Form::label('password', 'Hasło', ['class' => 'col-lg-2 col-form-label required', 'placeholder' => 'Hasło']) }}
                        <div class="col-sm-7">
                            <div class="form-group bmd-form-group">
                                {{ Form::password('password', ['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{ Form::label('password_confirmation', 'Potwierdź hasło', ['class' => 'col-lg-2 col-form-label', 'placeholder' => 'Potwierdź hasło']) }}
                        <div class="col-sm-7">
                            <div class="form-group bmd-form-group">
                                {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
                    {{ Form::submit('Zmień', ['class' => 'btn btn-rose pull-right']) }}
                    {{ Form::close() }}
                </div>
            </div>          
        </div>
        <div class="col-md-4">
            <div class="card card-profile">
                <div class="card-avatar">

                </div>
                <div class="card-body">
                    <h6 class="card-category text-gray"></h6>
                    <h4 class="card-title"></h4>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('after-scripts')

<script type="text/javascript">
    $(document).ready(function() {
        Backend.Profile.init();
    });
</script>
@endsection
