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
                {{-- Task Type --}}
                <div class="col-sm-12 form-group bmd-form-group {{ $errors->has('type_id') ? ' has-danger' : '' }}">
                  @if ($taskType->count())
                  <select name="type_id" class="form-control select2 type-select" data-placeholder="Wybierz Rodzaj">
                    <option></option>
                    @foreach ($taskType as $type)
                    <option value="{{$type->id}}" {{ old('type_id') == $type->id ? "selected":"" }}>{{ $type->name }}</option>
                    @endforeach                  
                  </select>
                  @else
                  <p>Brak dostępnych Rodzajów Zadań. {{ link_to_route('admin.taskType.index', 'Dodaj ') }}nowy Rodzaj Zadania.</p>
                  @endif
                </div>
              </div>             
              <div class="row">
                {{-- Service --}}
                <div class="col-sm-12 form-group bmd-form-group {{ $errors->has('service_id') ? ' has-danger' : '' }}">
                  @if ($services->count())
                  <select name="service_id" class="form-control select2 service-select" data-placeholder="Wybierz Usługę">
                    <option></option>
                    @foreach ($services as $service)
                    <option value="{{$service->id}}" {{ old('service_id') == $service->id ? "selected":"" }}>{{ $service->service_name }}</option>
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
              <div class="row">
                {{-- Start Date --}}
                <div class="col-sm-12 form-group bmd-form-group {{ $errors->has('start') ? ' has-danger' : '' }}">
                  <label class="bmd-label-floating">Data rozpoczęcia zadania</label>
                  <input class="form-control datetimepicker" name="start" id="input-start" type="text" value="{{ old('start') }}" />
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
                  <input class="form-control datetimepicker" name="end" id="input-end" type="text" value="{{ old('end') }}" />
                  @if ($errors->has('end'))
                  <span class="material-icons form-control-feedback">clear</span>
                  <span id="end-error" class="error text-danger" for="input-end">{{ $errors->first('end') }}</span>
                  @endif
                </div>
              </div>
              <div class="row">
                {{-- Team --}}
                <div class="col-sm-12 form-group bmd-form-group {{ $errors->has('team') ? ' has-danger' : '' }}">
                  <label class="bmd-label-floating">Wyznaczeni współpracownicy</label>
                  <textarea rows="8" cols="50" class="form-control" name="team" id="input-team">{{ old('team') }}</textarea>
                  @if ($errors->has('team'))
                  <span class="material-icons form-control-feedback">clear</span>
                  <span id="team-error" class="error text-danger" for="input-team">{{ $errors->first('team') }}</span>
                  @endif
                </div>
              </div>
              <div class="row">
                {{-- Note --}}
                <div class="col-sm-12 form-group bmd-form-group {{ $errors->has('note') ? ' has-danger' : '' }}">
                  <label class="bmd-label-floating">Notatki \ Uwagi</label>
                  <textarea rows="8" cols="50" class="form-control" name="note" id="input-note">{{ old('note') }}</textarea>
                  @if ($errors->has('note'))
                  <span class="material-icons form-control-feedback">clear</span>
                  <span id="note-error" class="error text-danger" for="input-note">{{ $errors->first('note') }}</span>
                  @endif
                </div>
              </div>
              <div class="row">
                {{-- Add Next  --}}
                <div class="col-sm-12 form-group bmd-form-group">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="checkbox" name="nextTask" value="0" id="nextTask" />
                        <span class="form-check-sign">
                          <span class="check"></span>
                        </span>
                        Dodać nastepne zadanie typu SERWIS z datą późniejszą o 6 miesięcy ?
                    </label>
                  </div>
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