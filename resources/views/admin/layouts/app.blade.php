<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
<div id="app">
    <header class="app-header navbar">
        @include('admin.layouts.header')
    </header>
    <div class="app-body">
        <div class="sidebar">
            @include('admin.layouts._nav')
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>
        <main class="main">
            @include('admin.layouts.breadcrumb')
            @if(Breadcrumbs::exists() && !request()->routeIs('home'))
                {!! Breadcrumbs::render() !!}
            @endif
            <div class="container-fluid">
                <div class="animated fadeIn">
                    @yield('content')
                </div>
            </div>
        </main>
        @include('admin.layouts.aside')
    </div>
    @include('admin.layouts.footer')
</div>
<script src="{{ asset('js/charts/main.js') }}" defer></script>
@yield('inline-script')
</body>
</html>
