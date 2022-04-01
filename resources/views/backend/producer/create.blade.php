@extends('backend.layouts.app', ['activePage' => 'producer-management', 'titlePage' => 'Zarządzanie Producentami'])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form method="post" action="{{ route('admin.producer.store') }}" autocomplete="off" class="form-horizontal">
          @csrf
          @method('post')
          <div class="card ">
            <div class="card-header card-header-icon card-header-primary">
              <div class="col-md-6">
                <div class="card-icon">
                  <i class="material-icons">engineering</i>
                </div>
                <h4 class="card-title">Dodaj Producenta</h4>
              </div>
            </div>
            <div class="card-body ">              
              <div class="row">
                {{-- Name --}}
                <div class="col-sm-12 form-group bmd-form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
                  <label class="bmd-label-floating">Nazwa</label>
                  <input class="form-control" name="name" id="input-name" type="text" value="{{ old('name') }}" />
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
                  <input class="form-control" name="description" id="input-description" type="text" value="{{ old('description') }}" />
                  @if ($errors->has('description'))
                  <span class="material-icons form-control-feedback">clear</span>
                  <span id="description-error" class="error text-danger" for="input-description">{{ $errors->first('description') }}</span>
                  @endif
                </div>
              </div>
            </div>
            <div class="card-footer">
              {{ link_to_route('admin.producer.index', 'Anuluj', [], ['class' => 'btn btn-danger btn-md']) }}
              {{ Form::submit('Dodaj', ['class' => 'btn btn-success btn-md']) }}
            </div>
          </div>
        </form>
      </div>
    </div>    
  </div>
</div>
@endsection