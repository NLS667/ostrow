@extends ('backend.layouts.app', ['activePage' => 'role-management', 'titlePage' => 'Zarządzanie Rolami'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                {{ Form::open(['route' => 'admin.access.role.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-role']) }}

                <div class="card">
                    <div class="card-header card-header-info d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Utwórz Rolę</h4>

                        <div class="card-tools">
                            @include('backend.access.includes.partials.role-header-buttons')
                        </div><!--box-tools pull-right-->
                    </div><!-- /.box-header -->

                    <div class="card-body">
                        <div class="form-group">
                            {{ Form::label('name', 'Nazwa', ['class' => 'col-lg-2 control-label required']) }}

                            <div class="col-lg-10">
                                {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => 'Nazwa', 'required' => 'required']) }}
                            </div><!--col-lg-10-->
                        </div><!--form control-->

                        <div class="form-group">
                            {{ Form::label('associated_permissions', 'Przydzielone Uprawnienia', ['class' => 'col-lg-2 control-label']) }}

                            <div class="col-lg-10">
                                {{ Form::select('associated_permissions', array('all' => 'Wszystkie', 'custom' => 'Wybrane'), 'all', ['class' => 'form-control select2 box-size']) }}

                                <div id="available-permissions" class="hidden mt-20" style="width: 700px; height: 200px; overflow-x: hidden; overflow-y: scroll;">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            @if ($permissions->count())
                                            @foreach ($permissions as $perm)
                                            <label class="control control--checkbox">
                                                <input type="checkbox" name="permissions[{{ $perm->id }}]" value="{{ $perm->id }}" id="perm_{{ $perm->id }}" {{ is_array(old('permissions')) && in_array($perm->id, old('permissions')) ? 'checked' : '' }} /> <label for="perm_{{ $perm->id }}">{{ $perm->display_name }}</label>
                                                <div class="control__indicator"></div>
                                            </label>
                                            <br/>
                                            @endforeach
                                            @else
                                            <p>There are no available permissions.</p>
                                            @endif
                                        </div><!--col-lg-6-->
                                    </div><!--row-->
                                </div><!--available permissions-->
                            </div><!--col-lg-3-->
                        </div><!--form control-->

                        <div class="form-group">
                            {{ Form::label('sort', 'Kolejność', ['class' => 'col-lg-2 control-label']) }}

                            <div class="col-lg-10">
                                {{ Form::text('sort', ($roleCount+1), ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.access.roles.sort')]) }}
                            </div><!--col-lg-10-->
                        </div><!--form control-->

                        <div class="form-group">
                            {{ Form::label('status', trans('validation.attributes.backend.access.roles.active'), ['class' => 'col-lg-2 control-label']) }}

                            <div class="col-lg-10">
                                <div class="control-group">
                                    <label class="control control--checkbox">
                                        {{ Form::checkbox('status', 1, true) }}
                                        <div class="control__indicator"></div>
                                    </label>
                                </div>
                            </div><!--col-lg-3-->
                        </div><!--form control-->
                        <div class="edit-form-btn">
                            {{ link_to_route('admin.access.role.index', 'Anuluj', [], ['class' => 'btn btn-danger btn-md']) }}
                            {{ Form::submit('Stwórz', ['class' => 'btn btn-primary btn-md']) }}
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
    {{ Html::script('js/backend/access/roles/script.js') }}
     <script type="text/javascript">
         Backend.Utils.documentReady(function(){
             Backend.Roles.init("rolecreate")
        });
    </script>
@endsection
