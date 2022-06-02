@extends('backend.layouts.app', ['activePage' => 'task-management', 'titlePage' => 'Zarządzanie Zadaniami'])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form method="post" action="{{ route('admin.task.update', $task) }}" autocomplete="off" class="form-horizontal">
          @csrf
          @method('put')
          <div class="card ">
            <div class="card-header card-header-icon card-header-primary">
              <div class="col-md-6">
                <div class="card-icon">
                  <i class="material-icons">task_alt</i>
                </div>
                <h4 class="card-title">Edytuj Zadanie</h4>
              </div>
            </div>
            <div class="card-body ">              
              <div class="row">
                {{-- Service --}}
                <div class="col-sm-12 form-group bmd-form-group {{ $errors->has('service_id') ? ' has-danger' : '' }}">
                  @if ($services->count())
                  <select name="service_id" class="form-control select2 service-select" data-placeholder="Wybierz Usługę">
                    <option></option>
                    @foreach ($services as $service)
                    <option value="{{$service->id}}" {{ $task->service_id == $service->id ? "selected":"" }}>{{ $service->service_name }}</option>
                    @endforeach                  
                  </select>
                  @endif
                </div>
              </div>
              <div class="row">
                {{-- Assigned User --}}
                <div class="col-sm-12 form-group bmd-form-group {{ $errors->has('assignee_id') ? ' has-danger' : '' }}">
                  @if ($assignees->count())
                  <select name="assignee_id" class="form-control select2 assignee-select" data-placeholder="Wybierz Pracownika">
                    <option></option>
                    @foreach ($assignees as $assignee)
                    <option value="{{$assignee->id}}" {{ $task->assignee_id == $assignee->id ? "selected":"" }}>{{ $assignee->first_name.' '.$assignee->last_name}}</option>
                    @endforeach                  
                  </select>
                  @endif
                </div>
              </div>
              <div class="row">
                {{-- Start Date --}}
                <div class="col-sm-12 form-group bmd-form-group {{ $errors->has('start') ? ' has-danger' : '' }}">
                  <label class="bmd-label-floating">Data rozpoczęcia zadania</label>
                  <input class="form-control datetimepicker" name="start" id="input-start" type="text" value="{{ old('start', $task->start) }}" />
                  @if ($errors->has('start'))
                  <span class="material-icons form-control-feedback">clear</span>
                  <span id="start-error" class="error text-danger" for="input-start">{{ $errors->first('start') }}</span>
                  @endif
                </div>
              </div>
              <div class="row">
                {{-- End Date --}}
                <div class="col-sm-12 form-group bmd-form-group {{ $errors->has('end') ? ' has-danger' : '' }}">
                  <label class="bmd-label-floating">Data zakończenia zadania</label>
                  <input class="form-control datetimepicker" name="end" id="input-end" type="text" value="{{ old('end', $task->end) }}" />
                  @if ($errors->has('end'))
                  <span class="material-icons form-control-feedback">clear</span>
                  <span id="end-error" class="error text-danger" for="input-end">{{ $errors->first('end') }}</span>
                  @endif
                </div>
              </div>
            </div>
            <div class="card-footer">
              {{ link_to_route('admin.task.index', 'Anuluj', [], ['class' => 'btn btn-danger btn-md']) }}
              {{ Form::submit('Dodaj', ['class' => 'btn btn-success btn-md']) }}
            </div>
          </div>
        </form>
      </div>
    </div>    
  </div>
</div>
@endsection
@section('after-scripts')
     <script type="text/javascript">
        
        Backend.Utils.documentReady(function(){
            Backend.Task.init();
            md.initFormExtendedDatetimepickers();
        });

    </script>
@endsection