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
                {{-- Client --}}
                <div class="col-sm-12 form-group bmd-form-group {{ $errors->has('client_id') ? ' has-danger' : '' }}">
                  @if ($clients->count())
                  <select name="client_id" class="form-control select2 client-select" data-placeholder="Wybierz Klienta">
                    <option></option>

                    @foreach ($clients as $client)
                    <option value="{{$client->id}}" {{ old('client_id') == $client->id ? "selected":"" }}>{{ $client->first_name.' '.$client->last_name }}</option>
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
                  @if ($serviceCategories->count())
                  <select name="service_cat_id" class="form-control select2 servicecat-select" data-placeholder="Wybierz Typ Usługi">
                    <option></option>
                    @foreach ($serviceCategories as $category)
                    <option value="{{$category->id}}" {{ old('service_cat_id') == $category->id ? "selected":"" }}>{{ $category->name }}</option>
                    @endforeach                  
                  </select>
                  @else
                  <p>Brak dostępnych Kategorii Usług. {{ link_to_route('admin.serviceCategory.index', 'Dodaj ') }}nową Kategorię Usług</p>
                  @endif
                </div>
              </div>              
              <div class="row">
                <div class="col-md-12">
                  <h4 class="title">Informacje o usłudze</h4>
                </div>
              </div>
              <div class="row">
                {{-- Offer Date --}}
                <div class="col-sm-4 form-group bmd-form-group {{ $errors->has('offered_at') ? ' has-danger' : '' }}">
                  <label class="bmd-label-floating">Data Oferty</label>
                  <input class="form-control datepicker" name="offered_at" id="input-offered_at" type="text" value="{{ old('offered_at') }}" />
                  @if ($errors->has('offered_at'))
                  <span class="material-icons form-control-feedback">clear</span>
                  <span id="offered_at-error" class="error text-danger" for="input-offered_at">{{ $errors->first('offered_at') }}</span>
                  @endif
                </div>
                {{-- Deal Date --}}
                <div class="col-sm-4 form-group bmd-form-group {{ $errors->has('signed_at') ? ' has-danger' : '' }}">
                  <label class="bmd-label-floating">Data Umowy</label>
                  <input class="form-control datepicker" name="signed_at" id="input-signed_at" type="text" value="{{ old('signed_at') }}" />
                  @if ($errors->has('signed_at'))
                  <span class="material-icons form-control-feedback">clear</span>
                  <span id="signed_at-error" class="error text-danger" for="input-signed_at">{{ $errors->first('signed_at') }}</span>
                  @endif
                </div>
                {{-- Montage Date --}}
                <div class="col-sm-4 form-group bmd-form-group {{ $errors->has('installed_at') ? ' has-danger' : '' }}">
                  <label class="bmd-label-floating">Data Montażu</label>
                  <input class="form-control datepicker" name="installed_at" id="input-installed_at" type="text" value="{{ old('installed_at') }}" />
                  @if ($errors->has('installed_at'))
                  <span class="material-icons form-control-feedback">clear</span>
                  <span id="installed_at-error" class="error text-danger" for="input-installed_at">{{ $errors->first('installed_at') }}</span>
                  @endif
                </div>
              </div>
              <div class="row">
                {{-- Deal Amount --}}
                <div class="col-sm-6 form-group bmd-form-group {{ $errors->has('deal_amount') ? ' has-danger' : '' }}">
                  <label class="bmd-label-floating">Kwota Umowy</label>
                  <input class="form-control{{ $errors->has('deal_amount') ? ' is-invalid' : '' }}" name="deal_amount" id="input-deal_amount" type="text" value="{{ old('deal_amount') }}" />
                  @if ($errors->has('deal_amount'))
                  <span class="material-icons form-control-feedback">clear</span>
                  <span id="deal_amount-error" class="error text-danger" for="input-deal_amount">{{ $errors->first('deal_amount') }}</span>
                  @endif
                </div>
              </div>
              <div id="advance">
                <div class="row">
                  {{-- Deal Advance --}}
                  <div class="col-sm-6 form-group bmd-form-group {{ $errors->has('deal_advance') ? ' has-danger' : '' }}">
                    <label class="bmd-label-floating">Zaliczka</label>
                    <input class="form-control{{ $errors->has('deal_advance') ? ' is-invalid' : '' }}" name="deal_advance[]" id="input-deal_advance" type="text" value="{{ old('deal_advance[0]') }}" />
                    @if ($errors->has('deal_advance'))
                    <span class="material-icons form-control-feedback">clear</span>
                    <span id="deal_advance-error" class="error text-danger" for="input-deal_advance">{{ $errors->first('deal_advance') }}</span>
                    @endif
                  </div>
                  <div class="col-sm-6">
                    <button type="button" name="add_advance" id="add_advance" class="btn btn-primary">Dodaj zaliczkę</button>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <h4 class="title">Urządzenia</h4>
                </div>
              </div>
              <div id="devices">
                <div class="row">
                  {{-- Model --}}
                  <div class="col-sm-6 form-group bmd-form-group {{ $errors->has('model_id') ? ' has-danger' : '' }}">
                    @if ($models->count())
                    <select name="models[]" class="form-control select2 model-select" data-placeholder="Wybierz Model Urządzenia">
                      <option></option>
                      @foreach ($models as $model)
                      <option value="{{$model->id}}" {{ old('model_id') == $model->id ? "selected":"" }}>{{ $model->producer->name.' '.$model->name}}</option>
                      @endforeach                  
                    </select>
                    @else
                    <p>Brak dostępnych Modeli. {{ link_to_route('admin.model.index', 'Dodaj ') }}nowy Model</p>
                    @endif
                  </div>
                  <div class="col-sm-6">
                    <button type="button" name="add_device" id="add_device" class="btn btn-primary">Dodaj urządzenie</button>
                  </div>
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
@section('after-scripts')
     <script type="text/javascript">
        
        Backend.Utils.documentReady(function(){
            Backend.Service.init();
            md.initFormExtendedDatetimepickers();
        });

        $(document).ready(function(){      
          var i=1;
          var y=1;

          $('#add_advance').click(function(){  
               i++;  
               $('#advance').append('<div class="row dynamic-added" id="adv_row'+i+'"><div class="col-sm-6 form-group bmd-form-group"><label class="bmd-label-floating">Zaliczka</label><input class="form-control" name="deal_advance[]" id="input-deal_advance" type="text" value="{{ old("deal_advance['+i+']") }}" /></div><div class="col-sm-6"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove_adv">X</button></div></div>'); 
          });

          $('#add_device').click(function(){  
               y++;  
               $('#devices').append('<div class="row dynamic-added" id="dev_row'+y+'"><div class="col-sm-6 form-group bmd-form-group"><select name="models[]" class="form-control select2 model-'+y+'-select" data-placeholder="Wybierz Model Urządzenia"><option></option>@foreach ($models as $model)<option value="{{$model->id}}" {{ old("models['+y+']") == $model->id ? "selected":"" }}>{{ $model->producer->name.' '.$model->name}}</option>@endforeach</select></div><div class="col-sm-6"><button type="button" name="remove" id="'+y+'" class="btn btn-danger btn_remove_dev">X</button></div></div>');

               $(".select2.model-"+y+"-select").select2({
                    placeholder: "Wybierz Model",
                    theme: "material"
                });
          });

          $(document).on('click', '.btn_remove_adv', function(){  
            var button_id = $(this).attr("id");   
            $('#adv_row'+button_id+'').remove();
          }); 

          $(document).on('click', '.btn_remove_dev', function(){  
            var button_id = $(this).attr("id");   
            $('#dev_row'+button_id+'').remove();
          }); 
        });
    </script>
@endsection