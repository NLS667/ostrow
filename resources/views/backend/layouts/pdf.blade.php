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
                font-size: 8px;
            }
            .border {
                border: solid 1px #ff0000;
            }
            .green-bg{
                background-color: #009900;
            }
            .white{
                color: #ffffff;
            }
            .typing-line{
                display: box;
                height: 15px;
                width: 100%;
                border-bottom-style: dashed;
            }
            .row {
                margin: 10px 0px 0px 0px !important;
                padding: 0px !important;
            }
        </style>
    </head>
    <body>               
        @yield('content')
    </body>
</html>