@extends ('backend.layouts.app', ['activePage' => 'menu-management', 'titlePage' => __('Zarządzanie Menu')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12"> 
                {{ Form::model($menu, ['route' => ['admin.menus.update', $menu], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role', 'files' => true]) }}

                <div class="card">
                    <div class="card-header card-header-icon card-header-info d-flex justify-content-between align-items-center">
                        <div class="col-md-6">
                            <div class="card-icon">
                                <i class="material-icons">list</i>
                            </div>
                            <h4 class="card-title">Edytuj Menu</h4>
                        </div>
                        <div class="card-tools">
                            @include('backend.menus.partials.header-buttons')
                        </div>
                    </div><!-- /.card-header -->

                    {{-- Including Form blade file --}}
                    <div class="card-body">
                        <div class="form-group">
                            @include("backend.menus.form")
                            <div class="edit-form-btn">
                                {{ link_to_route('admin.menus.index', 'Anuluj', [], ['class' => 'btn btn-danger btn-md']) }}
                                {{ Form::submit('Zmień', ['class' => 'btn btn-primary btn-md']) }}
                            </div>
                        </div>
                    </div><!--box-->
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
    @include("backend.menus.partials.modal")
@endsection