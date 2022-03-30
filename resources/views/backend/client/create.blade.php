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
            <div class="card-header card-header-primary d-flex justify-content-between align-items-center">
              <h4 class="card-title">Dodaj Klienta</h4>
              <div class="card-tools">
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a href="{{ route('admin.client.index') }}" class="nav-link btn btn-sm btn-primary">Powrót do listy</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="card-body ">

              {{-- First Name --}}
              <div class="row">
                <label class="col-sm-2 col-form-label">Imię</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('first_name') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="input-first_name" type="text" placeholder="Imię" value="{{ old('first_name') }}" required="true" aria-required="true"/>
                    @if ($errors->has('first_name'))
                    <span id="name-error" class="error text-danger" for="input-first_name">{{ $errors->first('first_name') }}</span>
                    @endif
                  </div>
                </div>
              </div>

              {{-- Last Name --}}
              <div class="row">
                <label class="col-sm-2 col-form-label">Nazwisko</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('last_name') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" id="input-last_name" type="text" placeholder="Nazwisko" value="{{ old('last_name') }}" required="true" aria-required="true"/>
                    @if ($errors->has('last_name'))
                    <span id="name-error" class="error text-danger" for="input-last_name">{{ $errors->first('last_name') }}</span>
                    @endif
                  </div>
                </div>
              </div>

              {{-- Email --}}
              <div class="row">
                <label class="col-sm-2 col-form-label">E-mail</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="E-mail" value="{{ old('email') }}" required />
                    @if ($errors->has('email'))
                    <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                    @endif
                  </div>
                </div>
              </div>

              {{-- Phone --}}
              <div class="row">
                <label class="col-sm-2 col-form-label">Nr telefonu</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('phone_nr') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('phone_nr') ? ' is-invalid' : '' }}" name="phone_nr" id="input-phone_nr" type="text" placeholder="nr telefonu" value="{{ old('phone_nr') }}" required />
                    @if ($errors->has('phone_nr'))
                    <span id="phone_nr-error" class="error text-danger" for="input-phone_nr">{{ $errors->first('phone_nr') }}</span>
                    @endif
                  </div>
                </div>
              </div>

              {{-- Associated Services --}}
              <div class="row">
                <label class="col-sm-2 col-form-label" for="status">Przypisane Usługi</label>
                <div class="col-sm-7">
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
      </div>
    </div>
  </div>
</div>
@endsection

@section('after-scripts')
     <script type="text/javascript">
        Backend.Utils.documentReady(function(){
            Backend.Users.selectors.getPremissionURL = "{{ route('admin.get.permission') }}";
            Backend.Users.init("create");
        });

        window.onload = function () {
            Backend.Users.windowloadhandler();
        };
    </script>
@endsection