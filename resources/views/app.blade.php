<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Cipta Progresa Usaha' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logocpu.png') }}"/>
    <!-- link tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- link font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @yield('styles')

</head>
<body>

<h1 class="text-3xl font-bold text-red-600 bg-purple-700">Tailwind Jalan ✅</h1>


    @yield('scripts')
</body>
</html>