@php
    use Illuminate\Support\Facades\Route;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('material') }}/img/favicon.png">

    <!-- Title -->
    <title>@yield('title', app_name())</title> 

    <!-- Meta -->
    <meta name="description" content="@yield('meta_description', 'CRM - Panel dla Ostrowia')">
    <meta name="author" content="@yield('meta_author', 'Sebastian Kosk')">
    @yield('meta')

    <!-- Styles -->
    @yield('before-styles')
    {{ Html::style(mix('css/app.css')) }}
    {{ Html::style(mix('css/app-custom.css')) }}
    @yield('after-styles')
 
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        @include('includes.nav')
        @yield('content')
    </div>

    <!-- Scripts -->
    @yield('before-scripts')
        {{ Html::script(mix('js/app.js')) }}
        {{ Html::script(mix('js/app-custom.js')) }}
    @yield('after-scripts')
    
</body>
</html>