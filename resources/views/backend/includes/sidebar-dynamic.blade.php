<!-- Main Sidebar Container -->
<div class="sidebar" data-color="orange" data-background-color="black" data-image="{{ asset('/img/sidebar-1.jpg') }}">
    <div class="logo">
        <a href="#" class="simple-text logo-mini">BK</a>
        <a href="#" class="simple-text logo-normal">BIO-KLIM</a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item {{ active_class(if_route('admin.index'), 'active', '') }}">
                <a class="nav-link" href="{{ route('admin.index') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Pulpit</p>
                </a>
            </li>
            {{ renderMenuItems(getMenuItems('backend', 1)) }}
            {{ renderMenuItems(getMenuItems('backend', 2)) }}
        </ul>
    </div><!-- /.sidebar-menu -->
</div><!-- /.sidebar -->