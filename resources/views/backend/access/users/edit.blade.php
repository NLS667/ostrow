@extends('backend.layouts.app', ['activePage' => 'user-management', 'titlePage' => __('Zarządzanie Użytkownikami')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('admin.access.user.update', $user) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">Edycja Użytkownika</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('admin.access.user.index') }}" class="btn btn-sm btn-primary">Powrót do listy</a>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">Imię</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('first_name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="name" id="input-first_name" type="text" placeholder="Imię" value="{{ old('first_name', $user->first_name) }}" required="true" aria-required="true"/>
                      @if ($errors->has('first_name'))
                        <span id="name-error" class="error text-danger" for="input-first_name">{{ $errors->first('first_name') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">Nazwisko</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('last_name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="name" id="input-last_name" type="text" placeholder="Imię" value="{{ old('last_name', $user->last_name) }}" required="true" aria-required="true"/>
                      @if ($errors->has('last_name'))
                        <span id="name-error" class="error text-danger" for="input-last_name">{{ $errors->first('last_name') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">E-mail</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="E-mail" value="{{ old('email', $user->email) }}" required />
                      @if ($errors->has('email'))
                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                      @endif
                    </div>
                  </div>
                </div>

                {{-- Status --}}
                @if ($user->id != 1)
                {{-- Confirmed --}}
                <div class="row"> 
                  {{ Form::label('confirmed', 'Potwierdzony?', ['class' => 'col-lg-2 col-form-label']) }}
                  <div class="col-sm-7">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="status" value="1" id="status" {{ $user->status == 1 ? 'checked' : '' }} />
                        <span class="form-check-sign">
                          <span class="check"></span>
                        </span>
                      </label>
                    </div>
                  </div>
                </div>

                {{-- Associated Roles --}}
                <div class="row">
                  {{ Form::label('status', 'Przypisane Role', ['class' => 'col-lg-2 col-form-label']) }}
                  <div class="col-sm-7">
                    <div class="form-group"> 
                      <div class="col-lg-12">
                        @if (count($roles) > 0)
                        @foreach($roles as $role)
                        <div>
                          <label for="role-{{$role->id}}" class="control control--radio">
                            <input type="radio" value="{{$role->id}}" name="assignees_roles[]" {{ is_array(old('assignees_roles')) ? (in_array($role->id, old('assignees_roles')) ? 'checked' : '') : (in_array($role->id, $userRoles) ? 'checked' : '') }} id="role-{{$role->id}}" class="get-role-for-permissions" />  &nbsp;&nbsp;{!! $role->name !!}
                            <div class="control__indicator"></div>
                            <a href="#" data-role="role_{{$role->id}}" class="show-permissions small">(<span class="show-text">Pokaż</span><span class="hide-text d-none">Ukryj</span> Uprawnienia)</a>
                          </label>
                        </div>
                        <div class="permission-list d-none" data-role="role_{{$role->id}}">
                                        @if ($role->all)
                                            Wszystkie Uprawnienia
                                        @else
                                            @if (count($role->permissions) > 0)
                                                <blockquote class="small">
                                                    @foreach ($role->permissions as $perm)
                                                        {{$perm->display_name}}<br/>
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
                      </div><!--col-lg-12-->
                    </div><!--form-group-->
                  </div>
                </div>

                {{-- Associated Permissions --}}
                <div class="row">
                  {{ Form::label('associated-permissions', 'Przydzielone Uprawnienia', ['class' => 'col-lg-2 col-form-label']) }}
                  <div class="col-sm-7">
                    <div class="form-group">
                        
                        <div class="col-lg-10">
                            <div id="available-permissions" class="d-none container" style="margin-top:10px; height: 200px; overflow-x: hidden; overflow-y: scroll;">
                                <div class="row">
                                    <div class="col-xs-12 get-available-permissions">
                                        @if ($permissions)

                                            @foreach ($permissions as $id => $display_name)
                                            <div class="form-check">
                                              <label  for="perm_{{ $id }}" class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="permissions[{{ $id }}]" value="{{ $id }}"  id="perm_{{ $id }}" {{ isset($userPermissions) && in_array($id, $userPermissions) ? 'checked' : '' }} />

                                                <span class="form-check-sign">
                                                  <span class="check"></span>
                                                </span>
                                              </label>
                                            </div>
                                            <br>
                                            @endforeach
                                        @else
                                            <p>Brak pasujących uprawnień.</p>
                                        @endif
                                    </div><!--col-lg-6-->
                                </div><!--row-->
                            </div><!--available permissions-->
                        </div><!--col-lg-3-->
                    </div><!--form control-->
                  </div>
                </div>
                @endif
                <div class="edit-form-btn">
                  {{ link_to_route('admin.access.user.index', 'Anuluj', [], ['class' => 'btn btn-danger btn-md']) }}
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