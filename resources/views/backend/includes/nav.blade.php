<!-- Navbar -->
  <nav class="main-header navbar navbar-expand fixed-top">

    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        {{ link_to_route('backend.index','Strona główna', [], ['class' => 'nav-link']) }}
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">0</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">{{ trans_choice('strings.backend.general.you_have.messages', 0, ['number' => 0]) }}</span>
          <div class="dropdown-divider"></div>
        </div>
      </li>
      <!-- Notifications Dropdown Menu --> 
      <li class="nav-item dropdown notifications-menu">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge notification-counter">0</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right notification-menu-container">
          <span class="dropdown-header">{{ trans_choice('strings.backend.general.you_have.notifications', 0, ['number' => 0]) }}</span>
          <div class="dropdown-divider"></div>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->