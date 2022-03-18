@extends ('backend.layouts.app', ['activePage' => 'user-change-password', 'titlePage' => 'Zmiana hasła'])


@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12"> 
                {{ Form::open(['route' => ['admin.access.user.change-password', $user], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'patch']) }}

                <div class="card">
                    <div class="card-header card-header-info">
                        <h4 class="card-title">Zmiana hasła użytkownika {{ $user->first_name $user->last_name}}</h4>
                    </div><!-- /.box-header -->

                    <div class="card-body">
                        <div class="form-group">
                            {{ Form::label('old password', 'Starre hasło', ['class' => 'col-lg-2 control-label required', 'placeholder' => 'Stare Hasło']) }}

                            <div class="col-lg-10">
                                {{ Form::password('old_password', ['class' => 'form-control  box-size']) }}
                            </div><!--col-lg-10-->
                        </div><!--form control-->
                        <div class="form-group">
                            {{ Form::label('password', 'Hasło', ['class' => 'col-lg-2 control-label required', 'placeholder' => 'Hasło']) }}

                            <div class="col-lg-10">
                                {{ Form::password('password', ['class' => 'form-control  box-size']) }}
                            </div><!--col-lg-10-->
                        </div><!--form control-->

                        <div class="form-group">
                            {{ Form::label('password_confirmation', 'Potwierdzenie hasła', ['class' => 'col-lg-2 control-label', 'placeholder' => 'Potwierdź hasło']) }}

                            <div class="col-lg-10">
                                {{ Form::password('password_confirmation', ['class' => 'form-control  box-size']) }}
                            </div><!--col-lg-10-->
                        </div><!--form control-->
                    </div><!-- /.box-body -->
                </div><!--box-->

                <div class="box box-info">
                    <div class="box-body">
                        <div class="float-left">
                            {{ link_to_route('admin.access.user.index', 'Anuluj', [], ['class' => 'btn btn-danger btn-md']) }}
                        </div><!--pull-left-->

                        <div class="float-right">
                            {{ Form::submit('Zmień', ['class' => 'btn btn-primary btn-md']) }}
                        </div><!--pull-right-->

                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->
                </div><!--box-->

                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection