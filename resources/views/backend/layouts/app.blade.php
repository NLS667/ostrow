<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', app_name())</title>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('material') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('material') }}/img/favicon.png">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    @yield('meta')

    <!-- Styles -->
    @yield('before-styles')
    {{ Html::style(mix('css/app.css')) }}
    @yield('after-styles')

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed" style="padding-top:0px;">
        <div class="loading" style="display:none"></div>
        @include('includes.partials.logged-in-as')
        <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <div class="wrapper" id="app">
            @include('backend.includes.sidebar-dynamic')            
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper main-panel">
                @include('backend.includes.nav')

                <!-- Main content -->
                @include('includes.partials.messages')
                @yield('content')
                @include('backend.includes.footer')

            </div><!-- /.content-wrapper -->
            
        </div><!-- ./wrapper -->
        
        <!-- JavaScripts -->
        @yield('before-scripts')
        {{ Html::script(mix('js/app.js')) }}
        @yield('after-scripts')
    </body>
</html>