<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Protokół Zadania</title>
        <link rel="stylesheet" type="text/css" href="{{ public_path('css/bootstrap.min.css') }}">
        <style>
            .page-break {
                page-break-after: always;
            }
        </style>
    </head>
    <body class="layout-fixed">               
        @yield('content')
    </body>
</html>