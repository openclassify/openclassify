@php
    $siteName = $generalSettings['site_name'] ?? config('app.name', 'OpenClassify');
    $siteLogoUrl = $generalSettings['site_logo_url'] ?? null;
    $pageTitle = trim($__env->yieldContent('title'));
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle !== '' ? $pageTitle.' - ' : '' }}{{ $siteName }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="user-auth-page">
    <main class="user-auth-shell">
        <div class="user-auth-frame">
            <section class="user-auth-panel">
                <a href="{{ route('home') }}" class="user-auth-brand" aria-label="{{ $siteName }}">
                    @if($siteLogoUrl)
                    <img src="{{ $siteLogoUrl }}" alt="{{ $siteName }}" class="user-auth-brand-image">
                    @else
                    <span class="brand-logo" aria-hidden="true"></span>
                    @endif
                    <span class="user-auth-brand-text">{{ $siteName }}</span>
                </a>

                <div class="user-auth-card">
                    @yield('content')
                </div>
            </section>
        </div>
    </main>
</body>
</html>
