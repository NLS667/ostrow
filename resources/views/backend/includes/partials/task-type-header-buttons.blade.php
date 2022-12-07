<!--Action Button-->
    @if(Active::checkUriPattern('admin/taskType'))
        @include('backend.access.includes.partials.header-export')
    @endif
<!--Action Button-->
<div class="btn-group">
  <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown">Działania
    <span class="caret"></span>
    <span class="sr-only">Zwiń/Rozwiń</span>
  </button>
  <ul class="dropdown-menu dropdown-menu-right" role="menu">
    <a href="{{route('admin.taskType.index')}}" class="dropdown-item"><span class="material-icons">list</span>Wszystkie Rodzaje Zadań</a>
    @permission('create-tasktype')
    <a href="{{route('admin.taskType.create')}}" class="dropdown-item"><span class="material-icons">add</span>Dodaj Rodzaj Zadań</a>
    @endauth
  </ul>
</div>