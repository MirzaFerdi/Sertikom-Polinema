<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>
    <title>Sertikom</title>
</head>
<body class="bg-gray-100 flex h-screen">
    @include('layouts.sidebar')

    <!-- Main Content -->
    <div class="flex-1 overflow-y-auto">
        @include('layouts.navbar')

        {{-- <div class="p-6"> --}}
            @yield('content')
        {{-- </div> --}}
    </div>

    <!-- Script JavaScript -->
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('script')
</body>
</html>
