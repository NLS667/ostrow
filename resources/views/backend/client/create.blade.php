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
            <div class="card-header card-header-icon card-header-primary">
              <div class="col-md-6">
                <div class="card-icon">
                  <i class="material-icons">face</i>
                </div>
                <h4 class="card-title">Dodaj Klienta</h4>
              </div>
            </div>
            <div class="card-body ">
                <div class="row">
                  <div class="col-md-6">
                    <div class="row">
                      {{-- First Name --}}
                      <div class="col-sm-12 form-group bmd-form-group {{ $errors->has('first_name') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">Imię</label>
                        <input class="form-control" name="first_name" id="input-first_name" type="text" value="{{ old('first_name') }}" />
                        @if ($errors->has('first_name'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="first_name-error" class="error text-danger" for="input-first_name">{{ $errors->first('first_name') }}</span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      {{-- Last Name --}}
                      <div class="col-sm-12 form-group bmd-form-group {{ $errors->has('last_name') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">Nazwisko</label>
                        <input class="form-control" name="last_name" id="input-last_name" type="text" value="{{ old('last_name') }}" />
                        @if ($errors->has('last_name'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="last_name-error" class="error text-danger" for="input-last_name">{{ $errors->first('last_name') }}</span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <h4 class="title">Adres montażu</h4>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                      {{-- Address Street --}}
                      <div class="col-sm-6 form-group bmd-form-group {{ $errors->has('adr_street') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">Ulica</label>
                        <input class="form-control" name="adr_street" id="input-adr_street" type="text" value="{{ old('adr_street') }}" />
                        @if ($errors->has('adr_street'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="adr_street-error" class="error text-danger" for="input-adr_street">{{ $errors->first('adr_street') }}</span>
                        @endif
                      </div>
                      {{-- Address Street Number--}}
                      <div class="col-sm-3 form-group bmd-form-group {{ $errors->has('adr_street_nr') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">Nr domu</label>
                        <input class="form-control" name="adr_street_nr" id="input-adr_street_nr" type="text" value="{{ old('adr_street_nr') }}" />
                        @if ($errors->has('adr_street_nr'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="adr_street_nr-error" class="error text-danger" for="input-adr_street_nr">{{ $errors->first('adr_street_nr') }}</span>
                        @endif
                      </div>
                      {{-- Address Home Number--}}
                      <div class="col-sm-3 form-group bmd-form-group {{ $errors->has('adr_home_nr') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">Nr mieszkania</label>
                        <input class="form-control" name="adr_home_nr" id="input-adr_home_nr" type="text" value="{{ old('adr_home_nr') }}" />
                        @if ($errors->has('adr_home_nr'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="adr_home_nr-error" class="error text-danger" for="input-adr_home_nr">{{ $errors->first('adr_home_nr') }}</span>
                        @endif
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4 form-group bmd-form-group {{ $errors->has('adr_zipcode') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">Kod Pocztowy</label>
                        <input class="form-control" name="adr_zipcode" id="input-adr_zipcode" type="text" value="{{ old('adr_zipcode') }}" />
                        @if ($errors->has('adr_zipcode'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="adr_zipcode-error" class="error text-danger" for="input-adr_zipcode">{{ $errors->first('adr_zipcode') }}</span>
                        @endif
                      </div>
                      <div class="col-sm-8 form-group bmd-form-group {{ $errors->has('adr_city') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">Miasto</label>
                        <input class="form-control" name="adr_city" id="input-adr_city" type="text" value="{{ old('adr_city') }}" />
                        @if ($errors->has('adr_city'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="adr_city-error" class="error text-danger" for="input-adr_city">{{ $errors->first('adr_city') }}</span>
                        @endif
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6 form-group bmd-form-group {{ $errors->has('adr_region') ? ' has-danger' : '' }}">
                        <label id="adr_regionSelectLabel" class="bmd-label-floating">Województwo</label>
                        <select id="adr_regionSelect" name="adr_region" class="form-control select2" data-placeholder="Wybierz Województwo">
                          <option></option>
                          @foreach ($regions as $key => $value)
                          <option value="{{$key}}">{{ $value }}</option>
                          @endforeach      
                        </select>
                        @if ($errors->has('adr_region'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="adr_region-error" class="error text-danger" for="input-adr_region">{{ $errors->first('adr_region') }}</span>
                        @endif
                      </div>
                      <div class="col-sm-6 form-group bmd-form-group {{ $errors->has('adr_country') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">Kraj</label>
                        <input class="form-control" name="adr_country" id="input-adr_country" type="text" value="{{ old('adr_country') }}"/>
                        @if ($errors->has('adr_country'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="adr_country-error" class="error text-danger" for="input-adr_country">{{ $errors->first('adr_country') }}</span>
                        @endif
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4 form-group bmd-form-group {{ $errors->has('adr_lattitude') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">Szer. geo.</label>
                        <input class="form-control" name="adr_lattitude" id="input-adr_lattitude" type="text" value="{{ old('adr_lattitude') }}" />
                        @if ($errors->has('adr_lattitude'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="adr_lattitude-error" class="error text-danger" for="input-adr_lattitude">{{ $errors->first('adr_lattitude') }}</span>
                        @endif
                      </div>
                      <div class="col-sm-4 form-group bmd-form-group {{ $errors->has('adr_longitude') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">Dług. geo.</label>
                        <input class="form-control" name="adr_longitude" id="input-adr_longitude" type="text" value="{{ old('adr_longitude') }}" />
                        @if ($errors->has('adr_longitude'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="adr_longitude-error" class="error text-danger" for="input-adr_longitude">{{ $errors->first('adr_longitude') }}</span>
                        @endif
                      </div>
                      <div class="col-sm-4 form-group bmd-form-group">
                        <button class="coordinates btn btn-primary btn-round btn-block">
                          <i class="material-icons">travel_explore</i> Znajdź koordynaty
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <h4 class="title">Adres korespondencyjny</h4>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                      {{-- Address Street --}}
                      <div class="col-sm-6 form-group bmd-form-group {{ $errors->has('comm_adr_street') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">Ulica</label>
                        <input class="form-control" name="comm_adr_street" id="input-comm_adr_street" type="text" value="{{ old('comm_adr_street') }}" />
                        @if ($errors->has('comm_adr_street'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="comm_adr_street-error" class="error text-danger" for="input-comm_adr_street">{{ $errors->first('comm_adr_street') }}</span>
                        @endif
                      </div>
                      {{-- Address Street Number--}}
                      <div class="col-sm-3 form-group bmd-form-group {{ $errors->has('comm_adr_street_nr') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">Nr domu</label>
                        <input class="form-control" name="comm_adr_street_nr" id="input-comm_adr_street_nr" type="text" value="{{ old('comm_adr_street_nr') }}" />
                        @if ($errors->has('comm_adr_street_nr'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="comm_adr_street_nr-error" class="error text-danger" for="input-comm_adr_street_nr">{{ $errors->first('comm_adr_street_nr') }}</span>
                        @endif
                      </div>
                      {{-- Address Home Number--}}
                      <div class="col-sm-3 form-group bmd-form-group {{ $errors->has('comm_adr_home_nr') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">Nr mieszkania</label>
                        <input class="form-control" name="comm_adr_home_nr" id="input-comm_adr_home_nr" type="text" value="{{ old('comm_adr_home_nr') }}" />
                        @if ($errors->has('comm_adr_home_nr'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="comm_adr_home_nr-error" class="error text-danger" for="input-comm_adr_home_nr">{{ $errors->first('comm_adr_home_nr') }}</span>
                        @endif
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4 form-group bmd-form-group {{ $errors->has('comm_adr_zipcode') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">Kod Pocztowy</label>
                        <input class="form-control" name="comm_adr_zipcode" id="input-comm_adr_zipcode" type="text" value="{{ old('comm_adr_zipcode') }}" />
                        @if ($errors->has('comm_adr_zipcode'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="comm_adr_zipcode-error" class="error text-danger" for="input-comm_adr_zipcode">{{ $errors->first('comm_adr_zipcode') }}</span>
                        @endif
                      </div>
                      <div class="col-sm-8 form-group bmd-form-group {{ $errors->has('comm_adr_city') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">Miasto</label>
                        <input class="form-control" name="comm_adr_city" id="input-comm_adr_city" type="text" value="{{ old('comm_adr_city') }}" />
                        @if ($errors->has('comm_adr_city'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="comm_adr_city-error" class="error text-danger" for="input-comm_adr_city">{{ $errors->first('comm_adr_city') }}</span>
                        @endif
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6 form-group bmd-form-group {{ $errors->has('comm_adr_region') ? ' has-danger' : '' }}">
                        <label id="comm_adr_regionSelectLabel" class="bmd-label-floating">Województwo</label>
                        <select id="comm_adr_regionSelect" name="comm_adr_region" class="form-control select2" data-placeholder="Wybierz Województwo">
                          <option></option>
                          @foreach ($regions as $key => $value)
                          <option value="{{$key}}">{{ $value }}</option>
                          @endforeach      
                        </select>
                        @if ($errors->has('comm_adr_region'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="comm_adr_region-error" class="error text-danger" for="input-comm_adr_region">{{ $errors->first('comm_adr_region') }}</span>
                        @endif
                      </div>
                      <div class="col-sm-6 form-group bmd-form-group {{ $errors->has('comm_adr_country') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">Kraj</label>
                        <input class="form-control" name="comm_adr_country" id="input-comm_adr_country" type="text" value="{{ old('comm_adr_country') }}"/>
                        @if ($errors->has('comm_adr_country'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="comm_adr_country-error" class="error text-danger" for="input-comm_adr_country">{{ $errors->first('comm_adr_country') }}</span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <h4 class="title">Dodatkowe uwagi</h4>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 form-group bmd-form-group {{ $errors->has('extra_info') ? ' has-danger' : '' }}">
                    <textarea rows="8" cols="50" class="form-control" name="extra_info" id="input-extra_info">{{ old('extra_info') }}</textarea>
                    @if ($errors->has('extra_info'))
                    <span class="material-icons form-control-feedback">clear</span>
                    <span id="extra_info-error" class="error text-danger" for="input-extra_info">{{ $errors->first('extra_info') }}</span>
                    @endif
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <h4 class="title">Dane kontaktowe</h4>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12" id="contacts">
                    @php
                    $counter = 1;
                    @endphp
                    <div class="row">
                      {{-- Contacts name --}}
                      <div class="col-sm-3 form-group bmd-form-group is-filled {{ $errors->has('contacts.0') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">Osoba</label>
                        <input class="form-control" name="contacts[]" id="input-contacts" type="text" value="Główny" readonly />
                        @if ($errors->has('contacts.0'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="contacts-error" class="error text-danger" for="input-contacts">{{ $errors->first('contacts.0') }}</span>
                        @endif
                      </div>
                      {{-- Contacts email --}}
                      <div class="col-sm-3 form-group bmd-form-group {{ $errors->has('emails.0') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">Email</label>
                        <input class="form-control" name="emails[]" id="input-emails" type="text" value="{{ old('emails.0') }}" />
                        @if ($errors->has('emails.0'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="emails-error" class="error text-danger" for="input-emails">{{ $errors->first('emails.0') }}</span>
                        @endif
                      </div>
                      {{-- Contacts phones --}}
                      <div class="col-sm-3 form-group bmd-form-group {{ $errors->has('phones.0') ? ' has-danger' : '' }}">
                        <label class="bmd-label-floating">Nr telefonu</label>
                        <input class="form-control" name="phones[]" id="input-phones" type="text" value="{{ old('phones.0') }}" />
                        @if ($errors->has('phones.0'))
                        <span class="material-icons form-control-feedback">clear</span>
                        <span id="phones-error" class="error text-danger" for="input-phones">{{ $errors->first('phones.0') }}</span>
                        @endif
                      </div>
                      <div class="col-sm-3">
                        <button type="button" name="add_contact" id="add_contact" class="btn btn-primary">Dodaj kontakt</button>
                      </div>
                    </div>
                    @if(old('emails'))
                    @for ($i = 1; $i < count(old('emails')); $i++)
                    <div class="row dynamic-added" id="row{{$i}}">
                          {{-- Contacts name --}}
                          <div class="col-sm-3 form-group bmd-form-group is-filled {{ $errors->has('contacts.'.$i) ? ' has-danger' : '' }}">
                            <label class="bmd-label-floating">Osoba</label>
                            <input class="form-control" name="contacts[]" id="input-contacts" type="text" value="{{ old('contacts.'.$i) }}" />
                            @if ($errors->has('contacts.'.$i))
                            <span class="material-icons form-control-feedback">clear</span>
                            <span id="contacts-error" class="error text-danger" for="input-contacts">{{ $errors->first('contacts.'.$i) }}</span>
                            @endif
                          </div>
                          {{-- Contacts email --}}
                          <div class="col-sm-3 form-group bmd-form-group {{ $errors->has('emails.'.$i) ? ' has-danger' : '' }}">
                            <label class="bmd-label-floating">Email</label>
                            <input class="form-control" name="emails[]" id="input-emails" type="text" value="{{ old('emails.'.$i) }}" />
                            @if ($errors->has('emails.'.$i))
                            <span class="material-icons form-control-feedback">clear</span>
                            <span id="emails-error" class="error text-danger" for="input-emails">{{ $errors->first('emails.'.$i) }}</span>
                            @endif
                          </div>
                          {{-- Contacts phones --}}
                          <div class="col-sm-3 form-group bmd-form-group {{ $errors->has('phones.'.$i) ? ' has-danger' : '' }}">
                            <label class="bmd-label-floating">Nr telefonu</label>
                            <input class="form-control" name="phones[]" id="input-phones" type="text" value="{{ old('phones.'.$i) }}" />
                            @if ($errors->has('phones.'.$i))
                            <span class="material-icons form-control-feedback">clear</span>
                            <span id="phones-error" class="error text-danger" for="input-phones">{{ $errors->first('phones.'.$i) }}</span>
                            @endif
                          </div>
                          <div class="col-sm-3">
                            <button type="button" name="remove" id="{{ $i }}" class="btn btn-danger btn_remove">X</button>
                          </div>
                        </div>
                        @php
                        $counter++;
                        @endphp
                      @endfor
                    @endif
                  </div>
                </div>
              </div>
            <div class="card-footer">
              {{ link_to_route('admin.client.index', 'Anuluj', [], ['class' => 'btn btn-danger btn-md']) }}
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
          Backend.Clients.selectors.coordinatesURL = "{{ route('admin.client.get.coordinates') }}";
          Backend.Clients.init();
        });

        window.onload = function () {
            Backend.Clients.windowloadhandler();
        };
        $(document).ready(function(){
          var count = {{ $counter }};
          var i=count-1;

          $('#add_contact').click(function(){  
               i++;  
               $('#contacts').append('<div class="row dynamic-added" id="row'+i+'"><div class="col-sm-3 form-group bmd-form-group"><label class="bmd-label-floating">Osoba</label><input class="form-control" name="contacts[]" id="input-contact-'+i+'" type="text" value="{{ old("contacts['+i+']") }}" /></div><div class="col-sm-3 form-group bmd-form-group"><label class="bmd-label-floating">Email</label><input class="form-control" name="emails[]" id="input-email-'+i+'" type="text" value="{{ old("emails['+i+']") }}" /></div><div class="col-sm-3 form-group bmd-form-group"><label class="bmd-label-floating">Nr telefonu</label><input class="form-control" name="phones[]" id="input-phone-'+i+'" type="text" value="{{ old("phones['+i+']") }}" /></div><div class="col-sm-3"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div></div>'); 
          });

          $(document).on('click', '.btn_remove', function(){  
            var button_id = $(this).attr("id");   
            $('#row'+button_id+'').remove();  
          });

          $('#adr_regionSelect').on('change', function (e) {
              $('#adr_regionSelectLabel').parent().addClass('is-filled');
          });
          $('#comm_adr_regionSelect').on('change', function (e) {
              $('#comm_adr_regionSelectLabel').parent().addClass('is-filled');
          });
        });
    </script>
@endsection