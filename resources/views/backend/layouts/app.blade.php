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
    {{ Html::style(mix('css/backend.css')) }}
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
        <div class="wrapper" id="app">
            @include('backend.includes.nav')
            @include('backend.includes.sidebar-dynamic')
            
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    @yield('page-header')
                </div>

                <!-- Main content -->
                <div class="content">
                    @include('includes.partials.messages')
                    @yield('content')
                </div><!-- /.content -->                
            </div><!-- /.content-wrapper -->
            @include('backend.includes.footer')
        </div><!-- ./wrapper -->
        
        <!-- JavaScripts -->
        @yield('before-scripts')
        {{ Html::script(mix('js/backend.js')) }}
        @yield('after-scripts')
    </body>
</html>