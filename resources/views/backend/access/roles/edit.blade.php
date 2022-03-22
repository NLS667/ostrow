@extends ('backend.layouts.app', ['activePage' => 'role-management', 'titlePage' => 'Zarządzanie Rolami'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                {{ Form::model($role, ['route' => ['admin.access.role.update', $role], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role']) }}

                <div class="card">
                    <div class="card-header card-header-info d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Edytuj Rolę</h4>
                        <ul class="nav nav-tabs">
                          <li class="nav-item">
                            <a href="{{ route('admin.access.role.index') }}" class="nav-link btn btn-sm btn-default">Powrót do listy</a>
                          </li>
                        </ul>
                    </div><!-- /.box-header -->

                    <div class="card-body">
                        <div class="row">
                            {{ Form::label('name', 'Nazwa', ['class' => 'col-lg-2 control-label required']) }}
                            <div class="col-sm-7">
                                <div class="form-group">
                                    {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => 'Nazwa', 'required' => 'required']) }}
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
                                    <div id="available-permissions" class="d-none container" style="margin-top:10px; height: 200px; overflow-x: hidden; overflow-y: scroll;">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                @if ($permissions->count())

                                                @foreach ($permissions as $perm)
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="permissions[{{ $perm->id }}]" value="{{ $perm->id }}" id="perm_{{ $perm->id }}" {{ is_array(old('permissions')) && in_array($perm->id, old('permissions')) ? 'checked' : '' }} />
                                                        {{ $perm->display_name }}
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
                                    {{ Form::text('sort', null, ['class' => 'form-control box-size', 'placeholder' => 'Kolejność']) }}
                                </div><!--form control-->
                            </div>
                        </div>
                        {{ old('status') }}
                       <div class="row">
                            {{ Form::label('status', 'Aktywna?', ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="status" value="1" id="status" {{ $role->status == 1 ? 'checked' : '' }} />
                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('associated_permissions', 'Przypisane Uprawnienia', ['class' => 'col-lg-2 control-label']) }}

                            <div class="col-lg-10">
                                {{ Form::select('associated_permissions', ['all' => 'Wszystkie', 'custom' => 'Wybrane'], $role->all ? 'wszystkie' : 'wybrane', ['class' => 'form-control select2 box-size']) }}

                                <div id="available-permissions" class="d-none container" style="margin-top:10px; height: 200px; overflow-x: hidden; overflow-y: scroll;">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            @if ($permissions->count())
                                            @foreach ($permissions as $perm)
                                            <label class="control control--checkbox">
                                                <input type="checkbox" name="permissions[{{ $perm->id }}]" value="{{ $perm->id }}" id="perm_{{ $perm->id }}" {{ is_array(old('permissions')) ? (in_array($perm->id, old('permissions')) ? 'checked' : '') : (in_array($perm->id, $rolePermissions) ? 'checked' : '') }} /> <label for="perm_{{ $perm->id }}">{{ $perm->display_name }}</label>
                                                <div class="control__indicator"></div>
                                            </label>
                                            <br/>
                                            @endforeach
                                            @else
                                            <p>Brak dostępnych uprawnień.</p>
                                            @endif
                                        </div><!--col-lg-6-->
                                    </div><!--row-->
                                </div><!--available permissions-->
                            </div><!--col-lg-3-->
                        </div><!--form control-->

                        <div class="form-group">
                            {{ Form::label('sort', 'Kolejność', ['class' => 'col-lg-2 control-label']) }}

                            <div class="col-lg-10">
                                {{ Form::text('sort', null, ['class' => 'form-control box-size', 'placeholder' => 'Kolejność']) }}
                            </div><!--col-lg-10-->
                        </div><!--form control-->
                        <div class="edit-form-btn">
                            {{ link_to_route('admin.access.role.index', 'Anuluj', [], ['class' => 'btn btn-danger btn-md']) }}
                            {{ Form::submit('Zmień', ['class' => 'btn btn-primary btn-md']) }}
                            <div class="clearfix"></div>
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
        Backend.Utils.documentReady(function(){
             Backend.Roles.init("edit")
        });
    </script>
@endsection