<!-- Main Sidebar Container -->
<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
    <div class="logo">
        <a href="#" class="simple-text logo-normal">
            OSTR CRM
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item {{ active_class(if_route('admin.index'), 'active', '') }}">
                <a class="nav-link" href="{{ route('admin.index') }}">
                  <i class="material-icons">dashboard</i>
                    <p>Pulpit</p>
                </a>
            </li>
        </ul>
    </div>
</div>

<aside class="main-sidebar sidebar-dark-dark elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.index') }}" class="brand-link">
        <span class="brand-text font-weight-light">OSTR CRM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav>
            <ul class="nav nav-sidebar flex-column" data-widget="treeview">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-header">{{ trans('menus.backend.sidebar.general') }}</li>
                <li class="nav-item {{ active_class(if_route('admin.index'), 'active', '') }}">
                    <a href="{{ route('admin.index') }} " class="nav-link">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        {{ trans('menus.backend.sidebar.dashboard') }}
                    </a>
                </li>
                {{ renderMenuItems(getMenuItems('backend', 1)) }}
            </ul>
        </nav><!-- /.sidebar-menu -->
    </div>
</aside><!-- /.sidebar -->