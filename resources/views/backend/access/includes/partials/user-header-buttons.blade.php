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
  <ul class="dropdown-menu" role="menu">
    <li class="dropdown-item"><a href="{{route('admin.access.user.index')}}"><i class="fas fa-list-ul"></i>Wszyscy Użytkownicy</a></li>
    @permission('create-user')
    <li class="dropdown-item"><a href="{{route('admin.access.user.create')}}"><i class="fas fa-plus"></i>Dodaj Użytkownika</a></li>
    @endauth
    @permission('view-deactive-user')
    <li class="dropdown-item"><a href="{{route('admin.access.user.deactivated')}}"><i class="fas fa-square"></i>Nieaktywni Użytkownicy</a></li>
    @endauth
    @permission('view-deleted-user')
    <li class="dropdown-item"><a href="{{route('admin.access.user.deleted')}}"><i class="fas fa-trash"></i>Usunięci Użytkownicy</a></li>
    @endauth
  </ul>
</div>