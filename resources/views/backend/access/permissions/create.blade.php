@extends ('backend.layouts.app', ['activePage' => 'permission-management', 'titlePage' => 'Zarządzanie Uprawnieniami'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                {{ Form::open(['route' => 'admin.access.permission.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission']) }}

                <div class="card">
                    <div class="card-header card-header-info d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Utwórz Uprawnienie</h4>
                        <ul class="nav nav-tabs">
                          <li class="nav-item">
                            <a href="{{ route('admin.access.permission.index') }}" class="nav-link btn btn-sm btn-default">Powrót do listy</a>
                          </li>
                        </ul>
                    </div><!-- /.box-header -->

                    <div class="card-body">
                        {{-- Including Form --}}
                        @include("backend.access.permissions.form")
                        <div class="card-footer">
                            {{ link_to_route('admin.access.permission.index', 'Anuluj', [], ['class' => 'btn btn-danger btn-md']) }}
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
