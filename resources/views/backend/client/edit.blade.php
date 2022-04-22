@extends('backend.layouts.app', ['activePage' => 'client-management', 'titlePage' => 'Zarządzanie Klientami'])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('admin.client.update', $client) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-icon card-header-primary">
                <div class="col-md-6">
                  <div class="card-icon">
                    <i class="material-icons">face</i>
                  </div>
                  <h4 class="card-title">Edytuj Klienta</h4>
                </div>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-6">
                    <div class="row">
                      {{-- First Name --}}
                      <div class="col-sm-12 form-group bmd-form-group {{ $errors->has('first_name') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">Imię</label>
                        <input class="form-control" name="first_name" id="input-first_name" type="text" value="{{ old('first_name', $client->first_name) }}" />
                        @if ($errors->has('first_name'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="first_name-error" class="error text-danger" for="input-first_name">{{ $errors->first('first_name') }}</span>
                        @endif
                      </div>
                    </div>
                    <div class="row">
                      {{-- Last Name --}}
                      <div class="col-sm-12 form-group bmd-form-group {{ $errors->has('last_name') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">Nazwisko</label>
                        <input class="form-control" name="last_name" id="input-last_name" type="text" value="{{ old('last_name', $client->last_name) }}" />
                        @if ($errors->has('last_name'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="last_name-error" class="error text-danger" for="input-last_name">{{ $errors->first('last_name') }}</span>
                        @endif
                      </div>
                    </div>
                    <div class="row">
                      {{-- Email --}}
                      <div class="col-sm-12 form-group bmd-form-group {{ $errors->has('email') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">E-mail</label>
                        <input class="form-control" name="email" id="input-email" type="text" value="{{ old('email', $client->email) }}"/>
                        @if ($errors->has('email'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                        @endif
                      </div>
                    </div>
                    <div class="row">
                      {{-- Phone --}}
                      <div class="col-sm-12 form-group bmd-form-group {{ $errors->has('phone_nr') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">Nr telefonu</label>
                        <input class="form-control" name="phone_nr" id="input-phone_nr" type="text" value="{{ old('phone_nr', $client->phone_nr) }}"/>
                        @if ($errors->has('phone_nr'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="phone_nr-error" class="error text-danger" for="input-phone_nr">{{ $errors->first('phone_nr') }}</span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      {{-- Address Street --}}
                      <div class="col-sm-6 form-group bmd-form-group {{ $errors->has('adr_street') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">Ulica</label>
                        <input class="form-control" name="adr_street" id="input-adr_street" type="text" value="{{ old('adr_street', $client->adr_street) }}" />
                        @if ($errors->has('adr_street'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="adr_street-error" class="error text-danger" for="input-adr_street">{{ $errors->first('adr_street') }}</span>
                        @endif
                      </div>
                      {{-- Address Street Number--}}
                      <div class="col-sm-3 form-group bmd-form-group {{ $errors->has('adr_street_nr') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">Nr domu</label>
                        <input class="form-control" name="adr_street_nr" id="input-adr_street_nr" type="text" value="{{ old('adr_street_nr', $client->adr_street_nr) }}" />
                        @if ($errors->has('adr_street_nr'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="adr_street_nr-error" class="error text-danger" for="input-adr_street_nr">{{ $errors->first('adr_street_nr') }}</span>
                        @endif
                      </div>
                      {{-- Address Home Number--}}
                      <div class="col-sm-3 form-group bmd-form-group {{ $errors->has('adr_home_nr') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">Nr mieszkania</label>
                        <input class="form-control" name="adr_home_nr" id="input-adr_home_nr" type="text" value="{{ old('adr_home_nr', $client->adr_home_nr) }}" />
                        @if ($errors->has('adr_home_nr'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="adr_home_nr-error" class="error text-danger" for="input-adr_home_nr">{{ $errors->first('adr_home_nr') }}</span>
                        @endif
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4 form-group bmd-form-group {{ $errors->has('adr_zipcode') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">Kod Pocztowy</label>
                        <input class="form-control" name="adr_zipcode" id="input-adr_zipcode" type="text" value="{{ old('adr_zipcode', $client->adr_zipcode) }}" />
                        @if ($errors->has('adr_zipcode'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="adr_zipcode-error" class="error text-danger" for="input-adr_zipcode">{{ $errors->first('adr_zipcode') }}</span>
                        @endif
                      </div>
                      <div class="col-sm-8 form-group bmd-form-group {{ $errors->has('adr_city') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">Miasto</label>
                        <input class="form-control" name="adr_city" id="input-adr_city" type="text" value="{{ old('adr_city', $client->adr_city) }}" />
                        @if ($errors->has('adr_city'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="adr_city-error" class="error text-danger" for="input-adr_city">{{ $errors->first('adr_city') }}</span>
                        @endif
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6 form-group bmd-form-group {{ $errors->has('adr_region') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">Województwo</label>
                        <input class="form-control" name="adr_region" id="input-adr_region" type="text" value="{{ old('adr_region', $client->adr_region) }}" />
                        @if ($errors->has('adr_region'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="adr_region-error" class="error text-danger" for="input-adr_region">{{ $errors->first('adr_region') }}</span>
                        @endif
                      </div>
                      <div class="col-sm-6 form-group bmd-form-group {{ $errors->has('adr_country') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">Kraj</label>
                        <input class="form-control" name="adr_country" id="input-adr_country" type="text" value="{{ old('adr_country', $client->adr_country) }}"/>
                        @if ($errors->has('adr_country'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="adr_country-error" class="error text-danger" for="input-adr_country">{{ $errors->first('adr_country') }}</span>
                        @endif
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4 form-group bmd-form-group {{ $errors->has('adr_lattitude') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">Szer. geo.</label>
                        <input class="form-control" name="adr_lattitude" id="input-adr_lattitude" type="text" value="{{ old('adr_lattitude', $client->adr_lattitude) }}" />
                        @if ($errors->has('adr_lattitude'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="adr_lattitude-error" class="error text-danger" for="input-adr_lattitude">{{ $errors->first('adr_lattitude') }}</span>
                        @endif
                      </div>
                      <div class="col-sm-4 form-group bmd-form-group {{ $errors->has('adr_longitude') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">Dług. geo.</label>
                        <input class="form-control" name="adr_longitude" id="input-adr_longitude" type="text" value="{{ old('adr_longitude', $client->adr_longitude) }}" />
                        @if ($errors->has('adr_longitude'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="adr_longitude-error" class="error text-danger" for="input-adr_longitude">{{ $errors->first('adr_longitude') }}</span>
                        @endif
                      </div>
                      <div class="col-sm-4 form-group bmd-form-group">
                        <button class="coordinates btn btn-primary btn-round btn-block">
                          <i class="material-icons">travel_explore</i> Zmień koordynaty
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="edit-form-btn">
                  {{ link_to_route('admin.client.index', 'Anuluj', [], ['class' => 'btn btn-danger btn-md']) }}
                  {{ Form::submit('Zmień', ['class' => 'btn btn-primary btn-md']) }}
                </div>
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
          Backend.Clients.selectors.coordinatesURL = "{{ route('admin.client.get.coordinates') }}";
          Backend.Clients.init();
        });

        window.onload = function () {
            Backend.Clients.windowloadhandler();
        };
    </script>
@endsection