<!--Action Button-->
    @if(Active::checkUriPattern('admin/producer'))
        @include('backend.includes.partials.header-export')
    @endif
<!--Action Button-->
<div class="btn-group">
  <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown">Działania
    <span class="caret"></span>
    <span class="sr-only">Zwiń/Rozwiń</span>
  </button>
  <ul class="dropdown-menu dropdown-menu-right" role="menu">
    <a href="{{route('admin.producer.index')}}" class="dropdown-item"><span class="material-icons">list</span>Wszyscy Producenci</a>
    @permission('create-producer')
    <a href="{{route('admin.producer.create')}}" class="dropdown-item"><span class="material-icons">add</span>Dodaj Producenta</a>
    @endauth
  </ul>
</div>