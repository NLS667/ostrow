@extends('backend.layouts.app', ['activePage' => 'user-management', 'titlePage' => 'Zarządzanie użytkownikami'])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form method="post" action="{{ route('admin.access.user.store') }}" autocomplete="off" class="form-horizontal">
          @csrf
          @method('post')

          <div class="card ">
            <div class="card-header card-header-primary d-flex justify-content-between align-items-center">
              <h4 class="card-title">Dodaj Użytkownika</h4>
              <div class="card-tools">
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a href="{{ route('admin.access.user.index') }}" class="nav-link btn btn-sm btn-primary">Powrót do listy</a>
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

              {{-- Password --}}
              <div class="row">
                <label class="col-sm-2 col-form-label" for="input-password">Hasło</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" input type="password" name="password" id="input-password" placeholder="Hasło" value="" required />
                    @if ($errors->has('password'))
                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('password') }}</span>
                    @endif
                  </div>
                </div>
              </div>

              {{-- Password Confirmation --}}
              <div class="row">
                <label class="col-sm-2 col-form-label" for="input-password-confirmation">Potwierdź Hasło</label>
                <div class="col-sm-7">
                  <div class="form-group">
                    <input class="form-control" name="password_confirmation" id="input-password-confirmation" type="password" placeholder="Potwierdź Hasło" value="" required />
                  </div>
                </div>
              </div>

              {{-- Associated Roles --}}
              <div class="row">
                <label class="col-sm-2 col-form-label" for="status">Przypisane Role</label>
                <div class="col-sm-7">
                  <div class="form-group">
                    <div class="col-lg-8">
                      @if (count($roles) > 0)
                      @foreach($roles as $role)
                      <div>
                        <label for="role-{{$role->id}}" class="control control--radio">
                          <input type="radio" value="{{$role->id}}" name="assignees_roles[]" id="role-{{$role->id}}" class="get-role-for-permissions" {{ $role->id == 3 ? 'checked' : '' }} />  &nbsp;&nbsp;{!! $role->name !!}
                          <div class="control__indicator"></div>
                          <a href="#" data-role="role_{{ $role->id }}" class="show-permissions small">
                            (
                            <span class="show-text">Pokaż</span>
                            <span class="hide-text d-none">Ukryj</span>
                            Uprawnienia
                            )
                          </a>
                        </label>
                      </div>
                      <div class="permission-list d-none" data-role="role_{{ $role->id }}">
                        @if ($role->all)
                        Wszystkie Uprawnienia<br/><br/>
                        @else
                        @if (count($role->permissions) > 0)
                        <blockquote class="small">{{--
                          --}}@foreach ($role->permissions as $perm){{--
                          --}}{{$perm->display_name}}<br/>
                          @endforeach
                        </blockquote>
                        @else
                        Brak przydzielonych Uprawnień.<br/><br/>
                        @endif
                        @endif
                      </div><!--permission list-->
                      @endforeach
                      @else
                      Brak przypisanych Ról.
                      @endif
                    </div><!--col-lg-3-->
                  </div><!--form control-->
                </div>
              </div> 

              {{-- Associated Permissions --}}
              <div class="row">
                <label class="col-sm-2 col-form-label" for="associated-permissions">Przydzielone uprawnienia</label>
                <div class="col-sm-7">
                  <div class="form-group">
                    <div class="col-lg-12">
                      <div id="available-permissions" class="d-none container" style="margin-top:10px; height: 200px; overflow-x: hidden; overflow-y: scroll;">
                        <div class="row">
                          <div class="col-xs-12 get-available-permissions">

                          </div><!--col-lg-6-->
                        </div><!--row-->
                      </div><!--available permissions-->
                    </div><!--col-lg-3-->
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
        var associated = $("select[name='associated_permissions']");
        var associated_container = $("#available-permissions");

        if (associated.val() == "custom")
            associated_container.removeClass('d-none');
        else
            associated_container.addClass('d-none');

        associated.change(function() {
            if ($(this).val() == "custom")
                associated_container.removeClass('d-none');
            else
                associated_container.addClass('d-none');
        });

        Backend.Utils.documentReady(function(){
            Backend.Users.selectors.getPremissionURL = "{{ route('admin.get.permission') }}";
            Backend.Users.init("create");
        });

        window.onload = function () {
            Backend.Users.windowloadhandler();
        };
    </script>
@endsection