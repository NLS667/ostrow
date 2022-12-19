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
			                  <label class="col-sm-2 col-form-label">Protokół z zadania typu:</label>
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
			                      <input class="form-control" name="client_name" id="input-client_name" type="text" value="{{ $client->name }}" disabled/>
			                    </div>
			                  </div>
			                </div>
			                <div class="row">
			                  <label class="col-sm-2 col-form-label">Adres:</label>
			                  <div class="col-sm-7">
			                    <div class="form-group">
			                      <input class="form-control" name="client_address" id="input-client_address" type="text" value="{{ $client->address }}" disabled/>
			                    </div>
			                  </div>
			                </div>
			                <div class="row">
			                  <label class="col-sm-2 col-form-label">Tel. Kontaktowy:</label>
			                  <div class="col-sm-7">
			                    <div class="form-group">
			                      <input class="form-control" name="client_phone" id="input-client_phone" type="text" value="{{ $client->main_phone }}" disabled/>
			                    </div>
			                  </div>
			                </div>
			                <div class="row">
			                	<div class="col-sm-12">
			                		<h4 class="card-title">{{ $service->service_type}}</h4>
			                	</div>
			                </div>
			                <div class="row">
			                		
			                		@foreach($devices as $device)
			                		<div class="form-group col-sm-2">
			                			<input class="form-control" name="device['producer'][]" id="input-dev_producer" type="text" value="{{ $device->model->producer->name }}" disabled/>
			                		</div>
			                		<div class="form-group col-sm-2">
			                			<input class="form-control" name="device['model'][]" id="input-dev_model" type="text" value="{{ $device->model->name }}" disabled/>
			                		</div>
			                		<div class="form-group col-sm-5">
			                			<input class="form-control" name="device['serial_num'][]" id="input-dev_serial_num" type="text" value="{{ $device->serial_number }}" disabled/>
			                		</div>
			                		<div class="form-group col-sm-1">
			                			<input class="form-control" name="device['czyn_rodz'][]" id="input-czyn_rodz" type="text" value="" placeholder="Rodzaj Czynnika"/>
			                		</div>
			                		<div class="form-group col-sm-1">
			                			<input class="form-control" name="device['czyn_card'][]" id="input-czyn_card" type="text" value="" placeholder="Czynnik Karta"/>
			                		</div>
			                		<div class="form-group col-sm-1">
			                			<input class="form-control" name="device['czyn_added'][]" id="input-czyn_added" type="text" value="" placeholder="Czynnik dodany"/>
			                		</div>
			                		@endforeach
			                </div>
			                <div class="row">
			                  <label class="col-sm-2 col-form-label">Uwagi/Zalecenia</label>
			                  <div class="col-md-10 form-group bmd-form-group">
			                    <textarea rows="8" cols="50" class="form-control" name="extra" id="input-extra"></textarea>
			                  </div>
			                </div>
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