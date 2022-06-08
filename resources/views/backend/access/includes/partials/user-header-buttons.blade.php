<!--Action Button-->
    @if(Active::checkUriPattern('admin/access/user') || Active::checkUriPattern('admin/access/user/deleted') || Active::checkUriPattern('admin/access/user/deactivated'))
        @include('backend.access.includes.partials.header-export')
    @endif
<!--Action Button-->
<div class="btn-group">
  <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown">Działania
    <span class="caret"></span>
    <span class="sr-only">Zwiń/Rozwiń</span>
  </button>
  <ul class="dropdown-menu dropdown-menu-right" role="menu">
    <a href="{{route('admin.access.user.index')}}" class="dropdown-item"><span class="material-icons">list</span>Aktywni Użytkownicy</a>
    @permission('create-user')
    <a href="{{route('admin.access.user.create')}}" class="dropdown-item"><span class="material-icons">add</span>Dodaj Użytkownika</a>
    @endauth
    @permission('view-deactive-user')
    <a href="{{route('admin.access.user.deactivated')}}" class="dropdown-item"><span class="material-icons">lock</span>Nieaktywni Użytkownicy</a>
    @endauth
    @permission('view-deleted-user')
    <a href="{{route('admin.access.user.deleted')}}" class="dropdown-item"><span class="material-icons">delete</span>Usunięci Użytkownicy</a>
    @endauth
  </ul>
</div>