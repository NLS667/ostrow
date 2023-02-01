<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Protokół Zadania</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-grid.min.css') }}">
        <style>
            .page-break {
                page-break-after: always;
            }
            * {
                font-size: 12px;
            }
        </style>
    </head>
    <body class="layout-fixed">               
        @yield('content')
    </body>
</html>