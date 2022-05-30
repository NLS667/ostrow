<!--Action Button-->
    @if(Active::checkUriPattern('admin/client') || Active::checkUriPattern('admin/client/deleted') || Active::checkUriPattern('admin/client/deactivated'))
        @include('backend.includes.partials.header-export')
    @endif
<!--Action Button-->
<div class="btn-group">
  <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown">Działania
    <span class="caret"></span>
    <span class="sr-only">Zwiń/Rozwiń</span>
  </button>
  <ul class="dropdown-menu dropdown-menu-right" role="menu">
    <a href="{{route('admin.client.index')}}" class="dropdown-item"><span class="material-icons">list</span>Wszyscy Klienci</a>
    @permission('create-client')
    <a href="{{route('admin.client.create')}}" class="dropdown-item"><span class="material-icons">add</span>Dodaj Klienta</a>
    @endauth
    @permission('view-deactive-client')
    <a href="{{route('admin.client.deactivated')}}" class="dropdown-item"><span class="material-icons">lock</span>Nieaktywni Klienci</a>
    @endauth
    @permission('view-deleted-user')
    <a href="{{route('admin.client.deleted')}}" class="dropdown-item"><span class="material-icons">delete</span>Usunięci Klienci</a>
    @endauth
  </ul>
</div>