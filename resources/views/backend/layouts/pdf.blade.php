<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Protokół Zadania</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
        <style>
            .td-1{
                width: 8.333%;
            }
            .td-2{
                width:  16.666%;
            }
            .td-3{
                width:  25%;
            }
            .td-4{
                width: 33.333%;
            }
            .td-5{
                width: 41.666%;
            }
            .td-6{
                width: 50%;
            }
            .td-7{
                width: 58.333%;
            }
            .td-8{
                width: 66.666%;
            }
            .td-9{
                width: 75%;
            }
            .td-10{
                width: 83.333%
            }
            .td-11{
                width: 91.666%;
            }
            .mb-10{
                margin-bottom:  10px;
            }



            .page-break {
                page-break-after: always;
            }
            * {
                font-size: 10px;
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
            .col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
                border:0;
                padding:0;
                margin-left:-0.00001;
            }
            @media print { @page { size: auto; } }
        </style>
    </head>
    <body>               
        @yield('content')
    </body>
</html>