<!--Action Button-->
  @if(Active::checkUriPattern('admin/access/permission'))
    @include('backend.access.includes.partials.header-export')
  @endif
<!--Action Button-->
<div class="btn-group">
  <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown">Działania
    <span class="caret"></span>
    <span class="sr-only">Zwiń/Rozwiń</span>
  </button>
  <ul class="dropdown-menu dropdown-menu-right" role="menu">
    <a href="{{route('admin.access.permission.index')}}" class="dropdown-item"><i class="fas fa-list-ul"></i> Wszystkie Uprawnienia</a>
    @permission('create-permission')
    <a href="{{route('admin.access.permission.create')}}"><i class="fas fa-plus"></i> Dodaj Uprawnienie</a>
    @endauth
  </ul>
</div>