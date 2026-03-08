<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>403 Forbidden</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen font-sans antialiased bg-gray-100 flex items-center justify-center p-6">
    <div class="max-w-md w-full bg-white rounded-xl shadow p-6 text-center">
        <h1 class="text-2xl font-bold text-gray-900">403</h1>
        <p class="mt-2 text-gray-700">You do not have permission to access this page.</p>

        <div class="mt-6 flex items-center justify-center gap-3">
            <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                Home
            </a>

            @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                    Log out
                </button>
            </form>
            @else
            <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                Log in
            </a>
            @endauth
        </div>
    </div>
</body>
</html>
