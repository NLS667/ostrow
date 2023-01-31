<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Protokół Zadania</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    @yield('meta')

    <!-- Styles -->
    

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