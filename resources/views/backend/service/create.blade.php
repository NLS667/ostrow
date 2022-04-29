@extends('backend.layouts.app', ['activePage' => 'service-management', 'titlePage' => 'Zarządzanie Usługami'])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form method="post" action="{{ route('admin.service.store') }}" autocomplete="off" class="form-horizontal">
          @csrf
          @method('post')
          <div class="card ">
            <div class="card-header card-header-icon card-header-primary">
              <div class="col-md-6">
                <div class="card-icon">
                  <i class="material-icons">settings_suggest</i>
                </div>
                <h4 class="card-title">Dodaj Usługę</h4>
              </div>
            </div>
            <div class="card-body ">              
              <div class="row">
                @php
                  \Log::info(json_encode($clients));
                @endphp
                {{-- Client --}}
                <div class="col-sm-12 form-group bmd-form-group {{ $errors->has('client_id') ? ' has-danger' : '' }}">
                  @if ($clients->getCount())
                  <select name="client_id" class="form-control select2" data-placeholder="Wybierz Klienta">
                    <option></option>
                    @foreach ($clients as $client)
                    <option value="{{$client->client_id}}">{{ $client->first_name.' '.$client->last_name }}</option>
                    @endforeach                  
                  </select>
                  @else
                  <p>Brak dostępnych Klientów. {{ link_to_route('admin.client.index', 'Dodaj ') }}nowego Klienta</p>
                  @endif
                </div>
              </div>
              <div class="row">
                {{-- Service Category --}}
                <div class="col-sm-12 form-group bmd-form-group {{ $errors->has('service_cat_id') ? ' has-danger' : '' }}">
                  @if ($serviceCategories->getCount())
                  <select name="service_cat_id" class="form-control select2" data-placeholder="Wybierz Typ Usługi">
                    <option></option>
                    @foreach ($serviceCategories as $category)
                    <option value="{{$category->id}}">{{ $category->name }}</option>
                    @endforeach                  
                  </select>
                  @else
                  <p>Brak dostępnych Kategorii Usług. {{ link_to_route('admin.serviceCategory.index', 'Dodaj ') }}nową Kategorię Usług</p>
                  @endif
                </div>
              </div>
              <div class="row">
                {{-- Model --}}
                <div class="col-sm-12 form-group bmd-form-group {{ $errors->has('model_id') ? ' has-danger' : '' }}">
                  @if ($smodels->getCount())
                  <select name="model_id" class="form-control select2" data-placeholder="Wybierz Model Urządzenia">
                    <option></option>
                    @foreach ($models as $model)
                    <option value="{{$model->id}}">{{ $model->name }}</option>
                    @endforeach                  
                  </select>
                  @else
                  <p>Brak dostępnych Modeli. {{ link_to_route('admin.model.index', 'Dodaj ') }}nowy Model</p>
                  @endif
                </div>
              </div>
              <div class="row">
                {{-- Offer Date --}}
                <div class="col-sm-12 form-group bmd-form-group {{ $errors->has('offered_at') ? ' has-danger' : '' }}">
                  <label class="bmd-label-floating">Data Oferty</label>
                  <input class="form-control datepicker" name="offered_at" id="input-offered_at" type="text" value="{{ old('offered_at') }}" />
                  @if ($errors->has('offered_at'))
                  <span class="material-icons form-control-feedback">clear</span>
                  <span id="offered_at-error" class="error text-danger" for="input-offered_at">{{ $errors->first('offered_at') }}</span>
                  @endif
                </div>
              </div>              
            </div>
            <div class="card-footer">
              {{ link_to_route('admin.service.index', 'Anuluj', [], ['class' => 'btn btn-danger btn-md']) }}
              {{ Form::submit('Dodaj', ['class' => 'btn btn-success btn-md']) }}
            </div>
          </div>
        </form>
      </div>
    </div>    
  </div>
</div>
@endsection