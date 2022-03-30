@extends('backend.layouts.app', ['activePage' => 'client-management', 'titlePage' => 'Zarządzanie Klientami'])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form method="post" action="{{ route('admin.client.store') }}" autocomplete="off" class="form-horizontal">
          @csrf
          @method('post')

          <div class="card ">
            <div class="card-header card-header-icon card-header-primary d-flex justify-content-between align-items-center">
              <div class="col-md-6">
                <div class="card-icon">
                  <i class="material-icons">face</i>
                </div>
                <h4 class="card-title">Dodaj Klienta</h4>
              </div>
              <a href="{{ route('admin.client.index') }}" class="btn btn-sm btn-primary">Powrót do listy</a>              
            </div>
            <div class="card-body ">              
              <div class="row">
                {{-- First Name --}}
                <div class="col-sm-6">
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Imię</label>
                    <div class="col-sm-10">
                      <div class="form-group{{ $errors->has('first_name') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="input-first_name" type="text" placeholder="Imię" value="{{ old('first_name') }}" />
                        @if ($errors->has('first_name'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="first_name-error" class="error text-danger" for="input-first_name">{{ $errors->first('first_name') }}</span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                {{-- Last Name --}}
                <div class="col-sm-6">
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Nazwisko</label>
                    <div class="col-sm-10">
                      <div class="form-group{{ $errors->has('last_name') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" id="input-last_name" type="text" placeholder="Nazwisko" value="{{ old('last_name') }}" />
                        @if ($errors->has('last_name'))
                        <span id="last_name-error" class="error text-danger" for="input-last_name">{{ $errors->first('last_name') }}</span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                {{-- Address Street --}}
                <div class="col-sm-6">
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Ulica</label>
                    <div class="col-sm-10">
                      <div class="form-group{{ $errors->has('adr_street') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('adr_street') ? ' is-invalid' : '' }}" name="adr_street" id="input-adr_street" type="text" placeholder="ulica" value="{{ old('adr_street') }}" />
                        @if ($errors->has('adr_street'))
                        <span id="adr_street-error" class="error text-danger" for="input-adr_street">{{ $errors->first('adr_street') }}</span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                {{-- Address Street Number--}}
                <div class="col-sm-3">
                  <div class="row">
                    <label class="col-sm-4 col-form-label">Numer</label>
                    <div class="col-sm-8">
                      <div class="form-group{{ $errors->has('adr_street_nr') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('adr_street_nr') ? ' is-invalid' : '' }}" name="adr_street_nr" id="input-adr_street_nr" type="text" placeholder="numer" value="{{ old('adr_street_nr') }}" />
                        @if ($errors->has('adr_street_nr'))
                        <span id="adr_street_nr-error" class="error text-danger" for="input-adr_street_nr">{{ $errors->first('adr_street_nr') }}</span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                {{-- Address Home Number--}}
                <div class="col-sm-3">
                  <div class="row">
                    <label class="col-sm-6 col-form-label">Numer domu/mieszkania</label>
                    <div class="col-sm-6">
                      <div class="form-group{{ $errors->has('adr_home_nr') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('adr_home_nr') ? ' is-invalid' : '' }}" name="adr_home_nr" id="input-adr_home_nr" type="text" placeholder="numer domu" value="{{ old('adr_home_nr') }}" />
                        @if ($errors->has('adr_home_nr'))
                        <span id="adr_home_nr-error" class="error text-danger" for="input-adr_home_nr">{{ $errors->first('adr_home_nr') }}</span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="row">
                        <label class="col-sm-4 col-form-label">Kod Pocztowy</label>
                        <div class="col-sm-8">
                          <div class="form-group{{ $errors->has('adr_zipcode') ? ' has-danger' : '' }}">
                            <input class="form-control{{ $errors->has('adr_zipcode') ? ' is-invalid' : '' }}" name="adr_zipcode" id="input-adr_zipcode" type="text" placeholder="kod pocztowy" value="{{ old('adr_zipcode') }}" />
                            @if ($errors->has('adr_zipcode'))
                            <span id="adr_zipcode-error" class="error text-danger" for="input-adr_zipcode">{{ $errors->first('adr_zipcode') }}</span>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="row">
                        <label class="col-sm-4 col-form-label">Miasto</label>
                        <div class="col-sm-8">
                          <div class="form-group{{ $errors->has('adr_city') ? ' has-danger' : '' }}">
                            <input class="form-control{{ $errors->has('adr_city') ? ' is-invalid' : '' }}" name="adr_city" id="input-adr_city" type="text" placeholder="miasto" value="{{ old('adr_city') }}" />
                            @if ($errors->has('adr_city'))
                            <span id="adr_city-error" class="error text-danger" for="input-adr_city">{{ $errors->first('adr_city') }}</span>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="row">
                        <label class="col-sm-4 col-form-label">Woj.</label>
                        <div class="col-sm-8">
                          <div class="form-group{{ $errors->has('adr_region') ? ' has-danger' : '' }}">
                            <input class="form-control{{ $errors->has('adr_region') ? ' is-invalid' : '' }}" name="adr_region" id="input-adr_region" type="text" placeholder="województwo" value="{{ old('adr_region') }}" />
                            @if ($errors->has('adr_region'))
                            <span id="adr_region-error" class="error text-danger" for="input-adr_region">{{ $errors->first('adr_region') }}</span>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="row">
                        <label class="col-sm-4 col-form-label">Kraj</label>
                        <div class="col-sm-8">
                          <div class="form-group{{ $errors->has('adr_country') ? ' has-danger' : '' }}">
                            <input class="form-control{{ $errors->has('adr_country') ? ' is-invalid' : '' }}" name="adr_country" id="input-adr_country" type="text" placeholder="kraj" value="{{ old('adr_country') }}"/>
                            @if ($errors->has('adr_country'))
                            <span id="adr_country-error" class="error text-danger" for="input-adr_country">{{ $errors->first('adr_country') }}</span>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                {{-- Email --}}
                <div class="col-sm-6">
                  <div class="row">
                    <label class="col-sm-2 col-form-label">E-mail</label>
                    <div class="col-sm-10">
                      <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="E-mail" value="{{ old('email') }}"/>
                        @if ($errors->has('email'))
                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                {{-- Phone --}}
                <div class="col-sm-6">
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Nr telefonu</label>
                    <div class="col-sm-10">
                      <div class="form-group{{ $errors->has('phone_nr') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('phone_nr') ? ' is-invalid' : '' }}" name="phone_nr" id="input-phone_nr" type="text" placeholder="Nr telefonu" value="{{ old('phone_nr') }}"/>
                        @if ($errors->has('phone_nr'))
                        <span id="phone_nr-error" class="error text-danger" for="input-phone_nr">{{ $errors->first('phone_nr') }}</span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>     
              
              {{-- Associated Services --}}
              <div class="row">
                <label class="col-sm-1 col-form-label" for="status">Przypisane Usługi</label>
                <div class="col-sm-11">
                  <div class="form-group">
                      @if (count($services) > 0)
                      <select name="associated_services[]" class="form-control select2" multiple="multiple">
                      @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                      @endforeach
                      </select>
                      @else
                      Brak przypisanych Usług.
                      @endif
                  </div><!--form control-->
                </div>
              </div> 
              <div class="card-footer">
                <button type="submit" class="btn btn-fill btn-success">Dodaj</button>
              </div>
            </div>
          </div>
          </form>
          {{ $errors }}
      </div>
    </div>
  </div>
</div>
@endsection

@section('after-scripts')
     <script type="text/javascript">
        Backend.Utils.documentReady(function(){
            Backend.Clients.init("create");
        });
    </script>
@endsection