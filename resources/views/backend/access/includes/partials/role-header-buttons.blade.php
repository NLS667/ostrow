<!--Action Button-->
    @if(Active::checkUriPattern('admin/access/role'))
        @include('backend.access.includes.partials.header-export')
    @endif
<!--Action Button-->
<div class="btn-group">
  <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown">Action
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li class="dropdown-item"><a href="{{route('admin.access.role.index')}}"><i class="fas fa-list-ul"></i> {{trans('menus.backend.access.roles.all')}}</a></li>
    @permission('create-role')
    <li class="dropdown-item"><a href="{{route('admin.access.role.create')}}"><i class="fas fa-plus"></i> {{trans('menus.backend.access.roles.create')}}</a></li>
    @endauth
  </ul>
</div>