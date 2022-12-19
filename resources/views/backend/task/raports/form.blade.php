@extends ('backend.layouts.app', ['activePage' => 'task-management', 'titlePage' => __('Raport Zadania')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12"> 
                {{ Form::open(['route' => 'admin.task.store_raport', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'store-raport', 'files' => false]) }}

                <div class="card">
                    <div class="card-header card-header-icon card-header-info d-flex justify-content-between align-items-center">
                        <div class="col-md-6">
                            <div class="card-icon">
                                <i class="material-icons">inventory</i>
                            </div>
                            <h4 class="card-title">Wypełnij dane raportu</h4>
                        </div>
                    </div><!-- /.card-header -->

                    <div class="card-body">
                        <div class="form-group">

                        	
                            <div class="edit-form-btn">
                                {{ link_to_route('admin.task.index', 'Anuluj', [], ['class' => 'btn btn-danger btn-md']) }}
                                {{ Form::submit('Zapisz', ['class' => 'btn btn-primary btn-md']) }}
                            </div>
                        </div>
                    </div><!--box-->
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection