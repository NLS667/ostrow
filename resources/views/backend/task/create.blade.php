@extends('backend.layouts.app', ['activePage' => 'task-management', 'titlePage' => 'Zarządzanie Zadaniami'])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form method="post" action="{{ route('admin.task.store') }}" autocomplete="off" class="form-horizontal">
          @csrf
          @method('post')
          <div class="card ">
            <div class="card-header card-header-icon card-header-primary">
              <div class="col-md-6">
                <div class="card-icon">
                  <i class="material-icons">task_alt</i>
                </div>
                <h4 class="card-title">Dodaj Zadanie</h4>
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
                    <option value="{{$service->id}}" {{ old('service_id') == $service->id ? "selected":"" }}>{{ $service->id }}</option>
                    @endforeach                  
                  </select>
                  @else
                  <p>Brak dostępnych Usług. {{ link_to_route('admin.service.index', 'Dodaj ') }}nową Usługę</p>
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
                    <option value="{{$assignee->id}}" {{ old('assignee_id') == $assignee->id ? "selected":"" }}>{{ $assignee->first_name.' '.$assignee->last_name}}</option>
                    @endforeach                  
                  </select>
                  @else
                  <p>Brak dostępnych Pracowników. {{ link_to_route('admin.access.user.index', 'Dodaj ') }}nowego Pracownika</p>
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