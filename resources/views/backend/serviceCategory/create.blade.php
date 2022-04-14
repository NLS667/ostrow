@extends ('backend.layouts.app', ['activePage' => 'role-management', 'titlePage' => 'Zarządzanie Kategoriami Usługami'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                {{ Form::open(['route' => 'admin.serviceCategory.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-servicecat']) }}

                <div class="card">
                    <div class="card-header card-header-primary d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Dodaj Kategorię Usług</h4>
                        <ul class="nav nav-tabs">
                          <li class="nav-item">
                            <a href="{{ route('admin.serviceCategory.index') }}" class="nav-link btn btn-sm btn-default">Powrót do listy</a>
                          </li>
                        </ul>
                    </div><!-- /.card-header -->

                    <div class="card-body">
                        <div class="row">
                            {{ Form::label('name', 'Nazwa', ['class' => 'col-lg-2 col-form-label required']) }}
                            <div class="col-sm-7">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="Nazwa" value="{{ old('name') }}" required="true" aria-required="true"/>
                                    @if ($errors->has('name'))
                                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                                    @endif
                                </div><!--form control-->
                            </div>
                        </div>
                        
                        <div class="row">
                            {{ Form::label('description', 'Opis', ['class' => 'col-lg-2 col-form-label']) }}
                            <div class="col-sm-7">
                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <input class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="input-description" type="text" placeholder="Opis" value="{{ old('description') }}" required="true" aria-required="true"/>
                                    @if ($errors->has('description'))
                                    <span id="name-error" class="error text-danger" for="input-description">{{ $errors->first('description') }}</span>
                                    @endif
                                </div><!--form control-->
                            </div>
                        </div>
                        <div class="card-footer">
                            {{ link_to_route('admin.serviceCategory.index', 'Anuluj', [], ['class' => 'btn btn-danger btn-md']) }}
                            {{ Form::submit('Dodaj', ['class' => 'btn btn-primary btn-md']) }}
                        </div>
                    </div><!-- /.box-body -->
                </div><!--box-->
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
