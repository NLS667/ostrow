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
    <styles>
        * {
            width: 100%;
            margin:0px;
            padding:0px;
        };
    </styles>
    

    </head>
    <body class="layout-fixed">               
        @yield('content')
    </body>
</html>