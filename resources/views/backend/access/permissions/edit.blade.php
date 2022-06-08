@extends ('backend.layouts.app', ['activePage' => 'permission-management', 'titlePage' => 'Zarządzanie Uprawnieniami'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                {{ Form::model($permission, ['route' => ['admin.access.permission.update', $permission], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role']) }}

                <div class="card">
                    <div class="card-header card-header-icon card-header-info d-flex justify-content-between align-items-center">
                        <div class="col-md-6">
                            <div class="card-icon">
                                <i class="material-icons">assignment_turned_in</i>
                            </div>
                            <h4 class="card-title">Edytuj Uprawnienie</h4>
                        </div>
                        <div class="card-tools">
                            @include('backend.access.includes.partials.permission-header-buttons')
                        </div>
                    </div><!-- /.card-header -->

                    <div class="card-body">

                        {{-- Including Form --}}
                        @include("backend.access.permissions.form")

                        <div class="edit-form-btn">
                            {{ link_to_route('admin.access.permission.index', 'Anuluj', [], ['class' => 'btn btn-danger btn-md']) }}
                            {{ Form::submit('Zmień', ['class' => 'btn btn-primary btn-md']) }}
                        </div>
                    </div><!-- /.box-body -->
                </div><!--box-->
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection