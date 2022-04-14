<!--Action Button-->
    @if(Active::checkUriPattern('admin/serviceCategory'))
        @include('backend.access.includes.partials.header-export')
    @endif
<!--Action Button-->
<div class="btn-group">
  <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown">Działania
    <span class="caret"></span>
    <span class="sr-only">Zwiń/Rozwiń</span>
  </button>
  <ul class="dropdown-menu dropdown-menu-right" role="menu">
    <a href="{{route('admin.serviceCategory.index')}}" class="dropdown-item"><span class="material-icons">list</span>Wszystkie Kategorie Usług</a>
    @permission('create-service')
    <a href="{{route('admin.serviceCategory.create')}}" class="dropdown-item"><span class="material-icons">add</span>Dodaj Kategorię Usług</a>
    @endauth
  </ul>
</div>