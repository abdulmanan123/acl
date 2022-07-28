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
        <link href="{{ asset('css/jquery-confirm.min.css') }}" rel="stylesheet">

        <link href="{{ asset('css/all.min.css?v='.config('app.app_version')) }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css?v='.config('app.app_version')) }}" rel="stylesheet">
        <link href="{{ asset('css/dev-style.css?v='.config('app.app_version')) }}" rel="stylesheet">

        <!-- Custom Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

        @stack('styles')

        <!-- Scripts -->
        <!--<script src="{{ asset('js/app.js') }}" defer></script>-->

        <script type='text/javascript' src='{{ asset('js/jquery.min.js') }}'></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" ></script>

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            {{-- <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header> --}}

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            @include('layouts.footer')

        </div>

        @routes

        <script src="{{ asset('js/moment.min.js') }}"></script>
        <script src="{{ asset('js/loadingoverlay.min.js') }}"></script>
        <script src="{{ asset('js/jquery-confirm.min.js') }}"></script>

        <script src="{{ asset('js/common.js?v='.config('app.app_version')) }}"></script>

        @stack('scripts')

        @include('layouts.notification')
    </body>
</html>
