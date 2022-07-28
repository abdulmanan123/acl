<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <!--<link rel="stylesheet" href="{{ asset('css/app.css') }}">-->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/bootstrap-utilities.css') }}" rel="stylesheet">

        <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">

        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

        <!-- Custom Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

        <!-- Scripts -->
        <!--<script src="{{ asset('js/app.js') }}" defer></script>-->
        <script type='text/javascript' src='{{ asset('js/jquery.min.js') }}'></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
          crossorigin="anonymous"></script>

          <script src="{{ asset('js/jquery.mask.js') }}"></script>
    </head>
    <body class="login-page">
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
