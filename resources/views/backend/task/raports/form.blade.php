@extends ('backend.layouts.app', ['activePage' => 'task-management', 'titlePage' => __('Raport Zadania')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{ route('admin.task.storeRaport', $task) }}" autocomplete="off" class="form-horizontal">
		          @csrf
		          @method('put')

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
                        	<div class="row">
			                  <label class="col-sm-2 col-form-label">Protokół z czynności:</label>
			                  <div class="col-sm-7">
			                    <div class="form-group">
			                      <input class="form-control" name="task_type" id="input-task_type" type="text" value="{{ $task->type }}" disabled/>
			                    </div>
			                  </div>
			                </div>
			                <div class="row">
			                  <label class="col-sm-2 col-form-label">Imię/Nazwisko/Firma:</label>
			                  <div class="col-sm-7">
			                    <div class="form-group">
			                      <input class="form-control" name="task_type" id="input-task_type" type="text" value="{{ $client->name }}" disabled/>
			                    </div>
			                  </div>
			                </div>
			                <div class="row">
			                  <label class="col-sm-2 col-form-label">Imię/Nazwisko/Firma:</label>
			                  <div class="col-sm-7">
			                    <div class="form-group">
			                      <input class="form-control" name="task_type" id="input-task_type" type="text" value="{{ $client->address }}" disabled/>
			                    </div>
			                  </div>
			                </div>
			                <div class="row">
			                  <label class="col-sm-2 col-form-label">Imię/Nazwisko/Firma:</label>
			                  <div class="col-sm-7">
			                    <div class="form-group">
			                      <input class="form-control" name="task_type" id="input-task_type" type="text" value="{{ $client->main_phone }}" disabled/>
			                    </div>
			                  </div>
			                </div>

                        	{{ $task }}
                        	{{ $service }}
                        	{{ $client }}
                            <div class="edit-form-btn">
                                {{ link_to_route('admin.task.index', 'Anuluj', [], ['class' => 'btn btn-danger btn-md']) }}
                                {{ Form::submit('Zapisz', ['class' => 'btn btn-primary btn-md']) }}
                            </div>
                        </div>
                    </div><!--box-->
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection