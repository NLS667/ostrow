<!--Action Button-->
<div class="btn-group">
  <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown">Działania
    <span class="caret"></span>
    <span class="sr-only">Zwiń/Rozwiń</span>
  </button>
  <ul class="dropdown-menu dropdown-menu-right" role="menu">
    <a href="{{route('admin.client.index')}}" class="dropdown-item"><span class="material-icons">list</span>Wszyscy Producenci</a>
    @permission('create-producer')
    <a href="{{route('admin.client.create')}}" class="dropdown-item"><span class="material-icons">add</span>Dodaj Producenta</a>
    @endauth
  </ul>
</div>