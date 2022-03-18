@extends ('backend.layouts.app', ['activePage' => 'menu-management', 'titlePage' => __('Zarządzanie Menu')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12"> 
                {{ Form::open(['route' => 'admin.menus.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-menu', 'files' => false]) }}

                <div class="card">
                    <div class="card-header card-header-info d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Utwórz Menu</h4>
                        <div class="card-tools">
                            @include('backend.menus.partials.header-buttons')
                        </div><!--box-tools float-right-->
                    </div><!-- /.box-header -->

                    <div class="card-body">
                        <div class="form-group">
                            @include("backend.menus.form")
                            <div class="edit-form-btn">
                                {{ link_to_route('admin.menus.index', 'Anuluj', [], ['class' => 'btn btn-danger btn-md']) }}
                                {{ Form::submit('Utwórz', ['class' => 'btn btn-primary btn-md']) }}
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
