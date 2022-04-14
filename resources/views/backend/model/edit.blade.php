@extends('backend.layouts.app', ['activePage' => 'model-management', 'titlePage' => __('Zarządzanie Modelami')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('admin.model.update', $model) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')
            <div class="card ">
              <div class="card-header card-header-icon card-header-primary">
                <div class="col-md-6">
                  <div class="card-icon">
                    <i class="material-icons">inventory</i>
                  </div>
                  <h4 class="card-title">Edytuj Model</h4>
                </div>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('admin.model.index') }}" class="btn btn-sm btn-primary">Powrót do listy</a>
                  </div>
                </div>
                <div class="row">
                  {{-- Producer --}}
                  <div class="col-sm-12 form-group bmd-form-group {{ $errors->has('producer') ? ' has-danger' : '' }}">
                    @if ($producers->count())
                    <select name="producer" class="form-control select2" data-placeholder="Wybierz Producenta">
                      <option></option>
                      @foreach ($producers as $producer)
                        @if ($modelProducer == $producer->id)
                          <option value="{{$producer->id}}" selected>{{ $producer->name }}</option>
                        @else
                          <option value="{{$producer->id}}">{{ $producer->name }}</option>
                        @endif
                      @endforeach                  
                    </select>
                    @else
                    <p>Brak dostępnych Producentów. {{ link_to_route('admin.producer.index', 'Dodaj ') }}nowego Producenta</p>
                    @endif
                  </div>
                </div>
                <div class="row">
                  {{-- Name --}}
                  <div class="col-sm-12 form-group bmd-form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <label class="bmd-label-floating">Nazwa</label>
                    <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" value="{{ old('name', $model->name) }}" />
                    @if ($errors->has('name'))
                    <span class="material-icons form-control-feedback">clear</span>
                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                    @endif
                  </div>
                </div>
                <div class="row">
                  {{-- Description --}}
                  <div class="col-sm-12 form-group bmd-form-group {{ $errors->has('description') ? ' has-danger' : '' }}">
                    <label class="bmd-label-floating">Opis</label>
                    <input class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="input-description" type="text" value="{{ old('description', $model->description) }}" />
                    @if ($errors->has('description'))
                    <span class="material-icons form-control-feedback">clear</span>
                    <span id="description-error" class="error text-danger" for="input-description">{{ $errors->first('description') }}</span>
                    @endif
                  </div>
                </div>
                <div class="edit-form-btn">
                  {{ link_to_route('admin.model.index', 'Anuluj', [], ['class' => 'btn btn-danger btn-md']) }}
                  {{ Form::submit('Zmień', ['class' => 'btn btn-primary btn-md']) }}
                </div>
              </div>
            </div>
            {{ $model->name }}
            {{ $model->description }}
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('after-scripts')
     <script type="text/javascript">
        
        Backend.Utils.documentReady(function(){
            Backend.Model.init();
        });

    </script>
@endsection