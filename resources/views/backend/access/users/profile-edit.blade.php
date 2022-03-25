@extends ('backend.layouts.app', ['activePage' => 'profile-edit', 'titlePage' => 'Moje Konto'])

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            {{ Form::model($logged_in_user, ['route' => 'admin.profile.update', 'class' => 'form-horizontal', 'method' => 'PATCH']) }}
            <div class="card">
                <div class="card-header card-header-info">
                    <h4 class="card-title">Edycja Profilu</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        {{ Form::label('first_name', 'Imię', ['class' => 'col-lg-2 col-form-label']) }}
                        <div class="col-sm-7">
                            <div class="form-group">
                                
                                <div class="col-lg-10">
                                    {{ Form::input('text', 'first_name', null, ['class' => 'form-control box-size', 'placeholder' => 'Imię']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{ Form::label('last_name', 'Nazwisko', ['class' => 'col-lg-2 col-form-label']) }}
                        <div class="col-sm-7">
                            <div class="form-group">
                                
                                <div class="col-lg-10">
                                    {{ Form::input('text', 'last_name', null, ['class' => 'form-control box-size', 'placeholder' => 'Nazwisko']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="edit-form-btn">
                        {{ Form::submit('Zmień', ['class' => 'btn btn-success', 'id' => 'update-profile']) }}
                    </div>
                </div>
            </div>
            {{ Form::close() }}
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
