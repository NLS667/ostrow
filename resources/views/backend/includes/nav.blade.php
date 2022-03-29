<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top">
  <div class="container-fluid">
    <!-- Left navbar links -->
    <div class="navbar-wrapper">
      <div class="navbar-minimize">
        <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
          <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
          <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
          <div class="ripple-container"></div></button>
        </div>
        <a class="navbar-brand" href="#">{{ $titlePage }}</a>
      </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
    </button>

    <!-- Right navbar links -->
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link" id="navbarDropdownMenuLink" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
            <i class="material-icons">messages</i>
            <span class="notification messages-counter">0</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <span class="dropdown-header">{{ trans_choice('strings.backend.general.you_have.messages', 0, ['number' => 0]) }}</span>
            <div class="dropdown-divider"></div>
          </div>
        </li>
        <li class="nav-item dropdown notifications-menu">
          <a class="nav-link" id="navbarDropdownMenuLink" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
            <i class="material-icons">notifications</i>
            <span class="notification notifications-counter">0</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right notification-menu-container" aria-labelledby="navbarDropdownMenuLink">
            <span class="dropdown-header">{{ trans_choice('strings.backend.general.you_have.notifications', 0, ['number' => 0]) }}</span>
            <div class="dropdown-divider"></div>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="material-icons">person</i>
            <p class="d-lg-none d-md-block">
              Moje Konto
            </p>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
            <a class="dropdown-item" href="{{ route('admin.profile.edit') }}">Profil</a>
            <a class="dropdown-item" href="#">Ustawienia</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('auth.logout') }}">Wyloguj</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
  <!-- /.navbar -->