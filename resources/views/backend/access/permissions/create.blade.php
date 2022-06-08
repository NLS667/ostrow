@extends ('backend.layouts.app', ['activePage' => 'permission-management', 'titlePage' => 'Zarządzanie Uprawnieniami'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                {{ Form::open(['route' => 'admin.access.permission.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission']) }}

                <div class="card">
                    <div class="card-header card-header-icon card-header-info d-flex justify-content-between align-items-center">
                        <div class="col-md-6">
                            <div class="card-icon">
                                <i class="material-icons">assignment_turned_in</i>
                            </div>
                            <h4 class="card-title">Utwórz Uprawnienie</h4>
                        </div>
                        <div class="card-tools">
                            @include('backend.access.includes.partials.permission-header-buttons')
                        </div>
                    </div><!-- /.card-header -->

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
