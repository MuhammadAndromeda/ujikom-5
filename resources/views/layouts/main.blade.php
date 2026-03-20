<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} Page</title>
    @vite('resources/css/app.css')
</head>
<body>
    @include('partials.navbar')

    <main class="w-full bg-no-repeat bg-cover bg-center" style="background-image: url({{ asset('images/background.jpg') }})">
        @yield('content')
    </main>

    <script src="{{ asset('js/navbar.js') }}"></script>
</body>
</html>