<!--Action Button-->
    @if(Active::checkUriPattern('admin/service'))
        @include('backend.access.includes.partials.header-export')
    @endif
<!--Action Button-->
<div class="btn-group">
  <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown">Działania
    <span class="caret"></span>
    <span class="sr-only">Zwiń/Rozwiń</span>
  </button>
  <ul class="dropdown-menu dropdown-menu-right" role="menu">
    <a href="{{route('admin.service.index')}}" class="dropdown-item"><span class="material-icons">list</span>Wszystkie Usługi</a>
    @permission('create-service')
    <a href="{{route('admin.service.create')}}" class="dropdown-item"><span class="material-icons">add</span>Dodaj Usługę</a>
    @endauth
  </ul>
</div>