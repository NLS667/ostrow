<!--Action Button-->
@if(Active::checkUriPattern('admin/menus'))
    @include('backend.access.includes.partials.header-export')
@endif
<!--Action Button-->
<div class="btn-group">
  <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown">Działania
    <span class="caret"></span>
    <span class="sr-only">Zwiń/Rozwiń</span>
  </button>
  <ul class="dropdown-menu dropdown-menu-right" role="menu">
    <a href="{{route('admin.menus.index')}}" class="dropdown-item"><span class="material-icons">list</span>Wszystkie Menu</a>
    @permission('create-menu')
    <a href="{{route('admin.menus.create')}}" class="dropdown-item"><span class="material-icons">add</span>Dodaj Menu</a>
    @endauth
  </ul>
</div>