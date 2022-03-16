<!-- Main Sidebar Container -->
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
                <li class="nav-item {{ active_class(if_route('admin.home'), 'active', '') }}">
                    <a href="{{ route('admin.home') }} " class="nav-link">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        {{ trans('menus.backend.sidebar.dashboard') }}
                    </a>
                </li>
                <li class="nav-header">{{ trans('menus.backend.sidebar.sit') }}</li>
                {{ renderMenuItems(getMenuItems('backend', 2)) }}
                <li class="nav-header">{{ trans('menus.backend.sidebar.system') }}</li>
                {{ renderMenuItems(getMenuItems('backend', 1)) }}
            </ul>
        </nav><!-- /.sidebar-menu -->
    </div>
</aside><!-- /.sidebar -->