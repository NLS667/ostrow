<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Protokół Zadania</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
        <style>
            .page-break {
                page-break-after: always;
            }
            * {
                font-size: 12px;
            }
            .green-bg{
                background-color: #009900;
                color:  white;
            }
            .logo {
                width:  100%;
            }
        </style>
    </head>
    <body>               
        @yield('content')
    </body>
</html>