@extends ('backend.layouts.app', ['activePage' => 'role-management', 'titlePage' => 'Zarządzanie Rolami'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                {{ Form::open(['route' => 'admin.access.role.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-role']) }}

                <div class="card">
                    <div class="card-header card-header-icon card-header-info d-flex justify-content-between align-items-center">
                        <div class="col-md-6">
                            <div class="card-icon">
                                <i class="material-icons">assignment_ind</i>
                            </div>
                            <h4 class="card-title">Dodaj Rolę</h4>
                        </div>
                        <div class="card-tools">
                            @include('backend.access.includes.partials.role-header-buttons')
                        </div>
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
                                    <div id="available-permissions" class="d-none container" style="margin-top:10px; height: 200px; overflow-x: hidden; overflow-y: scroll;">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                @if ($permissions->count())

                                                @foreach ($permissions as $perm)
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="permissions[{{ $perm->id }}]" value="{{ $perm->id }}" id="perm_{{ $perm->id }}" />
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
                                    {{ Form::text('sort', ($roleCount+1), ['class' => 'form-control box-size', 'placeholder' => 'Kolejność']) }}
                                </div><!--form control-->
                            </div>
                        </div>

                        <div class="row">
                            {{ Form::label('status', 'Aktywna?', ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="status" value="1" id="status" />
                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            {{ link_to_route('admin.access.role.index', 'Anuluj', [], ['class' => 'btn btn-danger btn-md']) }}
                            {{ Form::submit('Dodaj', ['class' => 'btn btn-primary btn-md']) }}
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
             Backend.Roles.init("rolecreate")
        });
    </script>
@endsection
