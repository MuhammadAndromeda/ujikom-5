<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="text-center p-8 bg-white shadow-xl rounded-lg">
        <h1 class="text-4xl font-bold text-red-600 mb-4">403 - Forbidden</h1>
        <p class="text-gray-600 mb-6">You do not have permission to access the Admin Panel.</p>
        
        <div class="flex gap-4 justify-center">
            <!-- Back to your main website -->
            <a href="/" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                Go to Homepage
            </a>

            <!-- Forced Logout Button -->
            <form action="{{ filament()->getLogoutUrl() }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Logout and Try Another Account
                </button>
            </form>
        </div>
    </div>
</body>
</html>
