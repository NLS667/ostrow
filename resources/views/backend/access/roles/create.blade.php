@extends ('backend.layouts.app', ['activePage' => 'role-management', 'titlePage' => 'Zarządzanie Rolami'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                {{ Form::open(['route' => 'admin.access.role.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-role']) }}

                <div class="card">
                    <div class="card-header card-header-primary d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Dodaj Rolę</h4>
                        <ul class="nav nav-tabs">
                          <li class="nav-item">
                            <a href="{{ route('admin.access.role.index') }}" class="nav-link btn btn-sm btn-default">Powrót do listy</a>
                          </li>
                        </ul>
                    </div><!-- /.card-header -->

                    <div class="card-body">
                        <div class="row">
                            {{ Form::label('name', 'Nazwa', ['class' => 'col-lg-2 control-label required']) }}
                            <div class="col-sm-7">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="Nazwa" value="{{ old('name') }}" required="true" aria-required="true"/>
                                    @if ($errors->has('name'))
                                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                                    @endif
                                </div><!--form control-->
                            </div>
                        </div>
                        <div class="row">
                            {{ Form::label('associated_permissions', 'Przydzielone Uprawnienia', ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-sm-7">
                                <div class="form-group">
                                    {{ Form::select('associated_permissions', array('all' => 'Wszystkie', 'custom' => 'Wybrane'), 'all', ['class' => 'form-control select2 box-size']) }}
                                    <div id="available-permissions" class="hidden mt-20" style="width: 700px; height: 200px; overflow-x: hidden; overflow-y: scroll;">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                @if ($permissions->count())
                                                @foreach ($permissions as $perm)
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="permissions[{{ $perm->id }}]" value="{{ $perm->id }}" id="perm_{{ $perm->id }}" {{ is_array(old('permissions')) && in_array($perm->id, old('permissions')) ? 'checked' : '' }} />
                                                        $perm->display_name }}
                                                        <span class="form-check-sign">
                                                            <span class="check"></span>
                                                        </span>
                                                    </label>
                                                </div>
                                                <br/>
                                                @endforeach
                                                @else
                                                <p>Brak dostępnych uprawnień.</p>
                                                @endif
                                            </div><!--col-lg-6-->
                                        </div><!--row-->
                                    </div><!--available permissions-->
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            {{ Form::label('sort', 'Kolejność', ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-sm-7">
                                <div class="form-group">                                    
                                    {{ Form::text('sort', ($roleCount+1), ['class' => 'form-control box-size', 'placeholder' => 'Kolejność']) }}
                                </div><!--form control-->
                            </div>
                        </div>

                        <div class="row">
                            {{ Form::label('status', 'Aktywna?', ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <div class="control-group">
                                        <label class="control control--checkbox">
                                            {{ Form::checkbox('status', 1, true) }}
                                            <div class="control__indicator"></div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            {{ link_to_route('admin.access.role.index', 'Anuluj', [], ['class' => 'btn btn-danger btn-md']) }}
                            {{ Form::submit('Dodaj', ['class' => 'btn btn-primary btn-md']) }}
                        </div>
                        </div>
                    </div><!-- /.box-body -->
                </div><!--box-->
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('after-scripts')
     <script type="text/javascript">
        var associated = $("select[name='associated_permissions']");
        var associated_container = $("#available-permissions");

        if (associated.val() == "custom")
            associated_container.removeClass('d-none');
        else
            associated_container.addClass('d-none');

        associated.change(function() {
            if ($(this).val() == "custom")
                associated_container.removeClass('d-none');
            else
                associated_container.addClass('d-none');
        });

        Backend.Utils.documentReady(function(){
             Backend.Roles.init("rolecreate")
        });
    </script>
@endsection
