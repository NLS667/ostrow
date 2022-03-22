@extends ('backend.layouts.app', ['activePage' => 'permission-management', 'titlePage' => 'Zarządzanie Uprawnieniami'])


@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                {{ Form::model($permission, ['route' => ['admin.access.permission.update', $permission], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role']) }}

                <div class="card">
                    <div class="card-header card-header-info d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Edytuj Uprawnienie</h4>
                        <ul class="nav nav-tabs">
                          <li class="nav-item">
                            <a href="{{ route('admin.access.permission.index') }}" class="nav-link btn btn-sm btn-default">Powrót do listy</a>
                          </li>
                        </ul>
                    </div><!-- /.box-header -->

                    <div class="card-body">

                        {{-- Including Form --}}
                        @include("backend.access.permissions.form")

                        <div class="edit-form-btn">
                            {{ link_to_route('admin.access.permission.index', 'Anuluj', [], ['class' => 'btn btn-danger btn-md']) }}
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