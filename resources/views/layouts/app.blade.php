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
    $partnerCreateRoute = route('partner.listings.create');
    $partnerDashboardRoute = auth()->check()
        ? route('filament.partner.pages.dashboard', ['tenant' => auth()->id()])
        : $partnerLoginRoute;
    $availableLocales = config('app.available_locales', ['en']);
    $localeLabels = [
        'en' => 'English',
        'tr' => 'Türkçe',
        'ar' => 'العربية',
        'zh' => '中文',
        'es' => 'Español',
        'fr' => 'Français',
        'de' => 'Deutsch',
        'pt' => 'Português',
        'ru' => 'Русский',
        'ja' => '日本語',
    ];
    $isHomePage = request()->routeIs('home');
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ in_array(app()->getLocale(), ['ar']) ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $siteName }} @hasSection('title') - @yield('title') @endif</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Sora:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --oc-bg: #f5f6fa;
            --oc-surface: #ffffff;
            --oc-border: #e4e7ef;
            --oc-text: #191e2b;
            --oc-muted: #667085;
            --oc-primary: #ff4365;
            --oc-primary-soft: #ffe7ed;
            --oc-chip: #f1f3f8;
        }

        body {
            font-family: 'Sora', sans-serif;
            background: radial-gradient(circle at top right, #fce6ef 0%, #f5f6fa 28%);
            color: var(--oc-text);
        }

        .brand-mark {
            font-family: 'Pacifico', cursive;
        }

        .market-nav-surface {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: saturate(180%) blur(8px);
            border-bottom: 1px solid var(--oc-border);
        }

        .search-shell {
            border: 1px solid #d9ddea;
            background: #fbfcff;
            border-radius: 999px;
        }

        .chip-btn {
            border: 1px solid #d9ddea;
            background: var(--oc-chip);
            border-radius: 999px;
        }

        .btn-primary {
            background: linear-gradient(120deg, #ff516e, #ff2f57);
            color: #fff;
            border-radius: 999px;
        }

        [dir="rtl"] {
            text-align: right;
        }
    </style>
</head>
<body class="min-h-screen">
    <nav class="market-nav-surface sticky top-0 z-50">
        <div class="max-w-[1320px] mx-auto px-4 py-4">
            <div class="flex items-center gap-3 md:gap-4">
                <a href="{{ route('home') }}" class="shrink-0 flex items-center gap-2">
                    @if($siteLogoUrl)
                    <img src="{{ $siteLogoUrl }}" alt="{{ $siteName }}" class="h-9 w-auto rounded">
                    @endif
                    <span class="brand-mark text-3xl text-rose-500 leading-none">{{ $siteName }}</span>
                </a>
                <form action="{{ route('listings.index') }}" method="GET" class="hidden lg:flex flex-1 search-shell items-center gap-2 px-4 py-2.5">
                    <svg class="w-5 h-5 text-rose-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-4.35-4.35m1.6-5.05a7.25 7.25 0 11-14.5 0 7.25 7.25 0 0114.5 0z"/>
                    </svg>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="{{ __('messages.search_placeholder') }}"
                        class="w-full bg-transparent text-sm text-slate-700 placeholder:text-slate-400 focus:outline-none"
                    >
                    <button type="submit" class="text-xs font-semibold text-slate-500 hover:text-slate-700 transition">
                        {{ __('messages.search') }}
                    </button>
                </form>
                <button type="button" class="chip-btn hidden md:flex items-center gap-2 px-4 py-2 text-sm text-slate-700">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 21s7-6.2 7-11a7 7 0 10-14 0c0 4.8 7 11 7 11z"/>
                        <circle cx="12" cy="10" r="2.3" stroke-width="1.8" />
                    </svg>
                    <span>Istanbul, Türkiye</span>
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 9l6 6 6-6"/>
                    </svg>
                </button>
                <div class="ml-auto flex items-center gap-2 md:gap-3">
                    <details class="relative">
                        <summary class="chip-btn list-none cursor-pointer px-3 py-2 text-xs md:text-sm text-slate-700">
                            {{ strtoupper(app()->getLocale()) }}
                        </summary>
                        <div class="absolute right-0 mt-2 bg-white border border-slate-200 shadow-lg rounded-xl overflow-hidden min-w-28">
                            @foreach($availableLocales as $locale)
                            <a href="{{ route('lang.switch', $locale) }}" class="block px-3 py-2 text-sm hover:bg-slate-50 {{ app()->getLocale() === $locale ? 'font-semibold text-rose-500' : 'text-slate-700' }}">
                                {{ $localeLabels[$locale] ?? strtoupper($locale) }}
                            </a>
                            @endforeach
                        </div>
                    </details>
                    @auth
                    <a href="{{ route('favorites.index') }}" class="hidden sm:inline-flex text-sm font-medium text-slate-600 hover:text-slate-900 transition">Favorilerim</a>
                    <a href="{{ $partnerDashboardRoute }}" class="hidden sm:inline-flex text-sm font-medium text-slate-600 hover:text-slate-900 transition">Panel</a>
                    <a href="{{ $partnerCreateRoute }}" class="btn-primary px-4 md:px-5 py-2 text-sm font-semibold shadow-sm hover:brightness-95 transition">
                        + {{ __('messages.post_listing') }}
                    </a>
                    <form method="POST" action="{{ $partnerLogoutRoute }}" class="hidden sm:block">
                        @csrf
                        <button type="submit" class="text-sm text-slate-500 hover:text-rose-500 transition">{{ __('messages.logout') }}</button>
                    </form>
                    @else
                    <a href="{{ $partnerLoginRoute }}" class="bg-rose-50 text-rose-500 px-4 md:px-5 py-2 rounded-full text-sm font-semibold hover:bg-rose-100 transition">
                        {{ __('messages.login') }}
                    </a>
                    <a href="{{ $partnerCreateRoute }}" class="btn-primary px-4 md:px-5 py-2 text-sm font-semibold shadow-sm hover:brightness-95 transition">
                        {{ __('messages.post_listing') }}
                    </a>
                    @endauth
                </div>
            </div>
            <div class="mt-3 lg:hidden">
                <form action="{{ route('listings.index') }}" method="GET" class="search-shell flex items-center gap-2 px-3 py-2.5">
                    <svg class="w-4 h-4 text-rose-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-4.35-4.35m1.6-5.05a7.25 7.25 0 11-14.5 0 7.25 7.25 0 0114.5 0z"/>
                    </svg>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="{{ __('messages.search_placeholder') }}"
                        class="w-full bg-transparent text-sm text-slate-700 placeholder:text-slate-400 focus:outline-none"
                    >
                    <button type="submit" class="text-xs text-slate-500">{{ __('messages.search') }}</button>
                </form>
            </div>
            @if(! $isHomePage)
            <div class="mt-3 flex items-center gap-2 text-sm overflow-x-auto pb-1">
                <a href="{{ route('home') }}" class="chip-btn whitespace-nowrap px-4 py-2 hover:bg-slate-100 transition">{{ __('messages.home') }}</a>
                <a href="{{ route('categories.index') }}" class="chip-btn whitespace-nowrap px-4 py-2 hover:bg-slate-100 transition">{{ __('messages.categories') }}</a>
                <a href="{{ route('listings.index') }}" class="chip-btn whitespace-nowrap px-4 py-2 hover:bg-slate-100 transition">{{ __('messages.listings') }}</a>
            </div>
            @endif
        </div>
    </nav>
    @if(session('success'))
    <div class="max-w-[1320px] mx-auto px-4 pt-3">
        <div class="bg-emerald-100 border border-emerald-300 text-emerald-800 px-4 py-3 rounded-xl text-sm">{{ session('success') }}</div>
    </div>
    @endif
    @if(session('error'))
    <div class="max-w-[1320px] mx-auto px-4 pt-3">
        <div class="bg-rose-100 border border-rose-300 text-rose-700 px-4 py-3 rounded-xl text-sm">{{ session('error') }}</div>
    </div>
    @endif
    <main>@yield('content')</main>
    <footer class="mt-14 bg-slate-900 text-slate-300">
        <div class="max-w-[1320px] mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-white font-semibold text-lg mb-3">{{ $siteName }}</h3>
                    <p class="text-sm text-slate-400 leading-relaxed">{{ $siteDescription }}</p>
                </div>
                <div>
                    <h4 class="text-white font-medium mb-4">Hızlı Linkler</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Ana Sayfa</a></li>
                        <li><a href="{{ route('categories.index') }}" class="hover:text-white transition">Kategoriler</a></li>
                        <li><a href="{{ route('listings.index') }}" class="hover:text-white transition">Tüm İlanlar</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-medium mb-4">Hesap</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ $partnerLoginRoute }}" class="hover:text-white transition">{{ __('messages.login') }}</a></li>
                        <li><a href="{{ $partnerRegisterRoute }}" class="hover:text-white transition">{{ __('messages.register') }}</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-medium mb-4">Bağlantılar</h4>
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
                        <li>Henüz sosyal bağlantı eklenmedi.</li>
                        @endif
                    </ul>
                    <h4 class="text-white font-medium mb-3">Diller</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach($availableLocales as $locale)
                        <a href="{{ route('lang.switch', $locale) }}" class="text-xs {{ app()->getLocale() === $locale ? 'text-white' : 'hover:text-white' }} transition">{{ strtoupper($locale) }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="border-t border-slate-700 mt-8 pt-8 text-center text-sm text-slate-400">
                <p>© {{ date('Y') }} {{ $siteName }}. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <x-impersonate::banner />
</body>
</html>
