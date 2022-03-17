<!--Action Button-->
    @if(Active::checkUriPattern('admin/access/role'))
        @include('backend.access.includes.partials.header-export')
    @endif
<!--Action Button-->
<div class="btn-group">
  <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown">Działania
    <span class="caret"></span>
    <span class="sr-only">Zwiń/Rozwiń</span>
  </button>
  <ul class="dropdown-menu dropdown-menu-right" role="menu">
    <a href="{{route('admin.access.role.index')}}" class="dropdown-item"><i class="fas fa-list-ul"></i> Wszystkie Role</a>
    @permission('create-role')
    <a href="{{route('admin.access.role.create')}}" class="dropdown-item"><i class="fas fa-plus"></i> Dodaj Rolę</a>
    @endauth
  </ul>
</div>