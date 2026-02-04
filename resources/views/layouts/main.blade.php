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
    <nav class="w-full fixed top-0 py-6 bg-indigo-700 text-white flex justify-center items-center">
        @include('partials.navbar')
    </nav>

    <main class="w-full">
        @yield('content')
    </main>

    <footer class="w-full bg-indigo-700 py-20 flex justify-center items-center text-white">
        @include('partials.footer')
    </footer>
</body>
</html>