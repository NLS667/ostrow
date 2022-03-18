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
                    <div class="form-group">
                        {{ Form::label('confirmed', trans('validation.attributes.backend.access.users.confirmed'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-1">
                            <div class="control-group">
                                <label class="control control--checkbox">
                                    {{ Form::checkbox('confirmed', '1', $user->confirmed == 1) }}
                                    <div class="control__indicator"></div>
                                </label>
                            </div>
                        </div><!--col-lg-1-->
                    </div><!--form control-->

                    {{-- Associated Roles --}}
                    <div class="form-group">
                        {{ Form::label('status', trans('validation.attributes.backend.access.users.associated_roles'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-8">
                            @if (count($roles) > 0)
                                @foreach($roles as $role)
                                    <div>
                                    <label for="role-{{$role->id}}" class="control control--radio">
                                    <input type="radio" value="{{$role->id}}" name="assignees_roles[]" {{ is_array(old('assignees_roles')) ? (in_array($role->id, old('assignees_roles')) ? 'checked' : '') : (in_array($role->id, $userRoles) ? 'checked' : '') }} id="role-{{$role->id}}" class="get-role-for-permissions" />  &nbsp;&nbsp;{!! $role->name !!}
                                    <div class="control__indicator"></div>
                                    <a href="#" data-role="role_{{$role->id}}" class="show-permissions small">
                                        (
                                            <span class="show-text">{{ trans('labels.general.show') }}</span>
                                            <span class="hide-text hidden">{{ trans('labels.general.hide') }}</span>
                                            {{ trans('labels.backend.access.users.permissions') }}
                                        )
                                    </a>
                                    </label>
                                    </div>
                                    <div class="permission-list hidden" data-role="role_{{$role->id}}">
                                        @if ($role->all)
                                            {{ trans('labels.backend.access.users.all_permissions') }}
                                        @else
                                            @if (count($role->permissions) > 0)
                                                <blockquote class="small">
                                                    @foreach ($role->permissions as $perm)
                                                        {{$perm->display_name}}<br/>
                                                    @endforeach
                                                </blockquote>
                                            @else
                                                {{ trans('labels.backend.access.users.no_permissions') }}<br/><br/>
                                            @endif
                                        @endif
                                    </div><!--permission list-->
                                @endforeach
                            @else
                                {{ trans('labels.backend.access.users.no_roles') }}
                            @endif
                        </div><!--col-lg-3-->
                    </div><!--form control-->

                    {{-- Associated Permissions --}}
                    <div class="form-group">
                        {{ Form::label('associated-permissions', trans('validation.attributes.backend.access.roles.associated_permissions'), ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-10">
                            <div id="available-permissions" style="width: 700px; height: 200px; overflow-x: hidden; overflow-y: scroll;">
                                <div class="row">
                                    <div class="col-xs-12 get-available-permissions">
                                        @if ($permissions)

                                            @foreach ($permissions as $id => $display_name)
                                            <div class="control-group">
                                                <label class="control control--checkbox" for="perm_{{ $id }}">
                                                    <input type="checkbox" name="permissions[{{ $id }}]" value="{{ $id }}" id="perm_{{ $id }}" {{ isset($userPermissions) && in_array($id, $userPermissions) ? 'checked' : '' }} /> <label for="perm_{{ $id }}">{{ $display_name }}</label>
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </div>
                                            @endforeach
                                        @else
                                            <p>There are no available permissions.</p>
                                        @endif
                                    </div><!--col-lg-6-->
                                </div><!--row-->
                            </div><!--available permissions-->
                        </div><!--col-lg-3-->
                    </div><!--form control-->

                @endif
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">Zapisz</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection