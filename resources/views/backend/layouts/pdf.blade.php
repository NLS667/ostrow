<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Protokół Zadania</title>
    <!-- Styles -->
    @stack('styles')
    @yield('before-styles')
    {{ Html::style(mix('css/app.css')) }}
    {{ Html::style(mix('css/app-custom.css')) }}
    @yield('after-styles')
    

    </head>
    <body class="hold-transition layout-fixed" style="padding-top:0px;">
        <div class="loading" style="display:none"></div>
        @include('includes.partials.logged-in-as')
        <div class="wrapper" id="app">
            <div class="content-wrapper main-panel">                
                @yield('content')
            </div><!-- /.content-wrapper -->            
        </div><!-- ./wrapper -->
    </body>
</html>