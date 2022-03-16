<div class="wrapper ">
  @include('backend.layouts.navbars.sidebar')
  <div class="main-panel">
    @include('backend.layouts.navbars.navs.auth')
    @yield('content')
    @include('backend.layouts.footers.auth')
  </div>
</div>