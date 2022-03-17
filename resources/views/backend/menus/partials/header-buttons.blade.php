<!--Action Button-->
@if(Active::checkUriPattern('admin/menus'))
    <export-component></export-component>
@endif
<!--Action Button-->
<div class="btn-group">
  <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown">Działania
    <span class="caret"></span>
    <span class="sr-only">Zwiń/Rozwiń</span>
  </button>
  <ul class="dropdown-menu dropdown-menu-right" role="menu">
    <a href="{{route('admin.menus.index')}}" class="dropdown-item"><i class="fa fa-list-ul"></i> Wszystkie Menu</a>
    @permission('create-menu')
    <a href="{{route('admin.menus.create')}}" class="dropdown-item"><i class="fa fa-plus"></i> Dodaj Menu</a>
    @endauth
  </ul>
</div>