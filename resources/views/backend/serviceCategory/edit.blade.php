@extends('backend.layouts.app', ['activePage' => 'service-category-management', 'titlePage' => __('Zarządzanie Kategoriami Usług')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('admin.serviceCategory.update', $serviceCategory) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">Edycja Kategorii Usługi</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('admin.serviceCategory.index') }}" class="btn btn-sm btn-primary">Powrót do listy</a>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">Nazwa</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="Nazwa" value="{{ old('name', $serviceCategory->name) }}" required="true" aria-required="true"/>
                      @if ($errors->has('name'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">Skrót <small>(max. 5 liter)</small></label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('short_name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('short_name') ? ' is-invalid' : '' }}" name="short_name" id="input-short_name" type="text" placeholder="Skrót" value="{{ old('short_name', $serviceCategory->short_name) }}" required="true" aria-required="true"/>
                      @if ($errors->has('short_name'))
                        <span id="short_name-error" class="error text-danger" for="input-short_name">{{ $errors->first('short_name') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                            {{-- Type --}}
                            <div class="col-sm-12 form-group bmd-form-group {{ $errors->has('type') ? ' has-danger' : '' }}">
                              <select name="type" class="form-control select2" data-placeholder="Wybierz Typ">
                                <option></option>
                                <option value="Zwykła" {{ $serviceCategory->type == 'Zwykła' ? 'selected' : ''}} >Zwykła usługa</option>
                                <option value="Dodatkowa" {{ $serviceCategory->type == 'Dodatkowa' ? 'selected' : ''}} >Dodatkowa Usługa</option>
                              </select>
                            </div>
                          </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">Opis</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="input-description" type="text" placeholder="Opis" value="{{ old('description', $serviceCategory->description) }}" required="true" aria-required="true"/>
                      @if ($errors->has('description'))
                        <span id="description-error" class="error text-danger" for="input-description">{{ $errors->first('description') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="edit-form-btn">
                  {{ link_to_route('admin.serviceCategory.index', 'Anuluj', [], ['class' => 'btn btn-danger btn-md']) }}
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
            Backend.ServiceCat.init();
        });

    </script>
@endsection