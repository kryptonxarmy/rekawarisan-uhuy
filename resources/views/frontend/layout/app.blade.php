<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Reka Warisan' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logocpu.png') }}"/>
    <!-- link tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- link font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @yield('styles')
</head>
<body>
    <!-- Header Start -->
    @include('frontend.landing.header')
    <!-- Header End -->

    <!-- Content Start -->
    @yield('content')
    <!-- Content End -->

    <!-- Footer Start -->
    @include('frontend.landing.footer')
    <!-- Footer End -->

    @yield('scripts')
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
</body>
</html>