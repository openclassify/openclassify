@php
    $siteName = $generalSettings['site_name'] ?? config('app.name', 'OpenClassify');
    $siteDescription = $generalSettings['site_description'] ?? 'The marketplace for buying and selling everything.';
    $siteLogoUrl = $generalSettings['site_logo_url'] ?? null;
    $linkedinUrl = $generalSettings['linkedin_url'] ?? null;
    $instagramUrl = $generalSettings['instagram_url'] ?? null;
    $whatsappNumber = $generalSettings['whatsapp'] ?? null;
    $whatsappDigits = preg_replace('/\D+/', '', (string) $whatsappNumber);
    $whatsappUrl = $whatsappDigits !== '' ? 'https://wa.me/' . $whatsappDigits : null;
    $partnerLoginRoute = route('filament.partner.auth.login');
    $partnerRegisterRoute = route('register');
    $partnerLogoutRoute = route('filament.partner.auth.logout');
    $partnerCreateRoute = auth()->check()
        ? route('filament.partner.resources.listings.create', ['tenant' => auth()->id()])
        : $partnerLoginRoute;
    $partnerDashboardRoute = auth()->check()
        ? route('filament.partner.pages.dashboard', ['tenant' => auth()->id()])
        : $partnerLoginRoute;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ in_array(app()->getLocale(), ['ar']) ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $siteName }} @hasSection('title') - @yield('title') @endif</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; } [dir="rtl"] { text-align: right; }</style>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-sm border-b sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600 flex items-center gap-2">
                    @if($siteLogoUrl)
                    <img src="{{ $siteLogoUrl }}" alt="{{ $siteName }}" class="h-9 w-auto rounded">
                    @endif
                    <span>{{ $siteName }}</span>
                </a>
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600 transition">{{ __('messages.home') }}</a>
                    <a href="{{ route('categories.index') }}" class="text-gray-600 hover:text-blue-600 transition">{{ __('messages.categories') }}</a>
                    <a href="{{ route('listings.index') }}" class="text-gray-600 hover:text-blue-600 transition">{{ __('messages.listings') }}</a>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative group">
                        <button class="flex items-center text-gray-600 hover:text-blue-600 transition px-2 py-1 rounded border text-sm">
                            🌐 {{ strtoupper(app()->getLocale()) }}
                        </button>
                        <div class="absolute right-0 mt-1 bg-white shadow-lg rounded-lg border hidden group-hover:block z-50 w-32">
                            @foreach(config('app.available_locales', ['en']) as $locale)
                            <a href="{{ route('lang.switch', $locale) }}" class="block px-4 py-2 text-sm hover:bg-gray-50 {{ app()->getLocale() === $locale ? 'font-bold text-blue-600' : 'text-gray-700' }}">
                                {{ ['en'=>'English','tr'=>'Türkçe','ar'=>'العربية','zh'=>'中文','es'=>'Español','fr'=>'Français','de'=>'Deutsch','pt'=>'Português','ru'=>'Русский','ja'=>'日本語'][$locale] ?? $locale }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @auth
                    <a href="{{ $partnerCreateRoute }}" class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition font-medium text-sm">+ Post Ad</a>
                    <div class="relative group">
                        <button class="text-gray-600 hover:text-blue-600">{{ auth()->user()->name }}</button>
                        <div class="absolute right-0 mt-1 bg-white shadow-lg rounded-lg border hidden group-hover:block z-50 w-40">
                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">My Profile</a>
                            <a href="{{ $partnerDashboardRoute }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Dashboard</a>
                            <form method="POST" action="{{ $partnerLogoutRoute }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-50">Logout</button>
                            </form>
                        </div>
                    </div>
                    @else
                    <a href="{{ $partnerLoginRoute }}" class="text-gray-600 hover:text-blue-600 transition">{{ __('messages.login') }}</a>
                    <a href="{{ $partnerRegisterRoute }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition text-sm">{{ __('messages.register') }}</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 text-center">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 text-center">{{ session('error') }}</div>
    @endif
    <main>@yield('content')</main>
    <footer class="bg-gray-800 text-gray-400 mt-16 py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-white font-bold text-lg mb-4">{{ $siteName }}</h3>
                    <p class="text-sm">{{ $siteDescription }}</p>
                </div>
                <div>
                    <h4 class="text-white font-medium mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
                        <li><a href="{{ route('categories.index') }}" class="hover:text-white transition">Categories</a></li>
                        <li><a href="{{ route('listings.index') }}" class="hover:text-white transition">All Listings</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-medium mb-4">Account</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ $partnerLoginRoute }}" class="hover:text-white transition">Login</a></li>
                        <li><a href="{{ $partnerRegisterRoute }}" class="hover:text-white transition">Register</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-medium mb-4">Connect</h4>
                    <ul class="space-y-2 text-sm mb-4">
                        @if($linkedinUrl)
                        <li><a href="{{ $linkedinUrl }}" target="_blank" rel="noopener" class="hover:text-white transition">LinkedIn</a></li>
                        @endif
                        @if($instagramUrl)
                        <li><a href="{{ $instagramUrl }}" target="_blank" rel="noopener" class="hover:text-white transition">Instagram</a></li>
                        @endif
                        @if($whatsappUrl)
                        <li><a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" class="hover:text-white transition">WhatsApp</a></li>
                        @endif
                        @if(!$linkedinUrl && !$instagramUrl && !$whatsappUrl)
                        <li>No social links added yet.</li>
                        @endif
                    </ul>
                    <h4 class="text-white font-medium mb-3">Languages</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach(config('app.available_locales', ['en']) as $locale)
                        <a href="{{ route('lang.switch', $locale) }}" class="text-xs {{ app()->getLocale() === $locale ? 'text-white' : 'hover:text-white' }} transition">{{ strtoupper($locale) }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-sm">
                <p>© {{ date('Y') }} {{ $siteName }}. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <x-impersonate::banner />
</body>
</html>
