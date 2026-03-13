@php
    $siteName = $generalSettings['site_name'] ?? config('app.name', 'OpenClassify');
    $siteDescription = $generalSettings['site_description'] ?? 'The marketplace for buying and selling everything.';
    $siteLogoUrl = $generalSettings['site_logo_url'] ?? null;
    $linkedinUrl = $generalSettings['linkedin_url'] ?? null;
    $instagramUrl = $generalSettings['instagram_url'] ?? null;
    $whatsappNumber = $generalSettings['whatsapp'] ?? null;
    $whatsappDigits = preg_replace('/\D+/', '', (string) $whatsappNumber);
    $whatsappUrl = $whatsappDigits !== '' ? 'https://wa.me/' . $whatsappDigits : null;
    $loginRoute = route('login');
    $registerRoute = route('register');
    $logoutRoute = route('logout');
    $panelCreateRoute = auth()->check() ? route('panel.listings.create') : $loginRoute;
    $panelListingsRoute = auth()->check() ? route('panel.listings.index') : $loginRoute;
    $inboxRoute = auth()->check() ? route('panel.inbox.index') : $loginRoute;
    $favoritesRoute = auth()->check() ? route('favorites.index') : $loginRoute;
    $profileRoute = auth()->check() ? route('panel.profile.edit') : $loginRoute;
    $notificationsRoute = auth()->check() ? route('panel.listings.index') : $loginRoute;
    $demoEnabled = (bool) config('demo.enabled');
    $hasDemoSession = (bool) session('is_demo_session') || filled(session('demo_uuid'));
    $demoLandingMode = $demoEnabled && request()->routeIs('home') && !auth()->check() && !$hasDemoSession;
    $demoExpiresAt = session('demo_expires_at');
    $demoExpiresAt = filled($demoExpiresAt) ? \Illuminate\Support\Carbon::parse($demoExpiresAt) : null;
    $demoRemainingLabel = null;
    $demoRemainingCompactLabel = null;

    if ($demoExpiresAt?->isFuture()) {
        $remainingMinutes = now()->diffInMinutes($demoExpiresAt, false);
        $remainingHours = intdiv($remainingMinutes, 60);
        $remainingRemainderMinutes = $remainingMinutes % 60;
        $remainingParts = [];

        if ($remainingHours > 0) {
            $remainingParts[] = $remainingHours.' '.\Illuminate\Support\Str::plural('hour', $remainingHours);
        }

        if ($remainingRemainderMinutes > 0) {
            $remainingParts[] = $remainingRemainderMinutes.' '.\Illuminate\Support\Str::plural('minute', $remainingRemainderMinutes);
        }

        $demoRemainingLabel = $remainingParts !== [] ? implode(' ', $remainingParts) : 'less than a minute';
        $demoRemainingCompactLabel = trim(
            ($remainingHours > 0 ? $remainingHours.'h ' : '')
            .($remainingRemainderMinutes > 0 ? $remainingRemainderMinutes.'m' : '')
        );
        $demoRemainingCompactLabel = $demoRemainingCompactLabel !== '' ? $demoRemainingCompactLabel : '<1m';
    }
    $availableLocales = config('app.available_locales', ['en']);
    $localeLabels = [
        'en' => 'English',
        'tr' => 'Turkish',
        'ar' => 'Arabic',
        'zh' => 'Chinese',
        'es' => 'Español',
        'fr' => 'French',
        'de' => 'German',
        'pt' => 'Portuguese',
        'ru' => 'Russian',
        'ja' => 'Japanese',
    ];
    $headerCategories = collect($headerNavCategories ?? [])->values();
    $menuBrowseLinks = collect([
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'All Listings', 'url' => route('listings.index')],
        ['label' => 'Categories', 'url' => route('categories.index')],
    ]);
    $locationCountries = collect($headerLocationCountries ?? [])->values();
    $defaultCountryIso2 = strtoupper((string) config('app.default_country_iso2', 'TR'));
    $citiesRouteTemplate = \Illuminate\Support\Facades\Route::has('locations.cities')
        ? route('locations.cities', ['country' => '__COUNTRY__'], false)
        : '';
    $simplePage = trim((string) $__env->yieldContent('simple_page')) === '1';
    $headerAccount = is_array($headerAccountMeta ?? null) ? $headerAccountMeta : null;
    $headerMessageCount = max(0, (int) ($headerAccount['messages'] ?? 0));
    $headerNotificationCount = max(0, (int) ($headerAccount['notifications'] ?? 0));
    $headerFavoritesCount = max(0, (int) ($headerAccount['favorites'] ?? 0));
    $headerBadgeLabel = static fn (int $count): string => $count > 99 ? '99+' : (string) $count;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ in_array(app()->getLocale(), ['ar']) ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $siteName }} @hasSection('title') - @yield('title') @endif</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body
    data-auth-user-id="{{ auth()->id() ?? '' }}"
    data-inbox-channel="{{ auth()->check() ? 'users.'.auth()->id().'.inbox' : '' }}"
    @class([
    'min-h-screen font-sans antialiased',
    'bg-slate-50' => $demoLandingMode,
    'bg-[#f5f5f7]' => $simplePage && ! $demoLandingMode,
])>
    @if(! $demoLandingMode)
    @if($simplePage)
    <nav class="sticky top-0 z-50 border-b border-black/5 bg-white/80 backdrop-blur-2xl">
        <div class="mx-auto flex min-h-[76px] max-w-[1120px] items-center justify-between gap-4 px-4">
            <a href="{{ route('home') }}" class="oc-brand">
                @if($siteLogoUrl)
                <img src="{{ $siteLogoUrl }}" alt="{{ $siteName }}" class="oc-brand-image w-auto rounded-xl">
                @else
                <span class="brand-logo" aria-hidden="true"></span>
                @endif
                <span class="brand-text leading-none">{{ $siteName }}</span>
            </a>

            <div class="flex items-center gap-3">
                @auth
                <a href="{{ route('panel.listings.index') }}" class="inline-flex min-h-11 items-center justify-center rounded-full border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-700 transition hover:border-slate-300 hover:text-slate-900">
                    My Listings
                </a>
                @endauth
                <a href="{{ route('home') }}" class="inline-flex min-h-11 items-center justify-center rounded-full bg-slate-900 px-5 text-sm font-semibold text-white transition hover:bg-slate-700">
                    Exit
                </a>
            </div>
        </div>
    </nav>
    @else
    <nav class="market-nav-surface sticky top-0 z-50" data-anim-nav>
        <div class="oc-nav-wrap">
            <div class="oc-nav-main">
                <div class="oc-topbar">
                    <button
                        type="button"
                        class="header-utility oc-compact-menu-trigger"
                        data-mobile-menu-open
                        aria-label="Open navigation menu"
                        aria-controls="oc-mobile-menu"
                        aria-expanded="false"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 7h16M7 12h10M10 17h4"/>
                        </svg>
                    </button>

                    <a href="{{ route('home') }}" class="oc-brand">
                        @if($siteLogoUrl)
                        <img src="{{ $siteLogoUrl }}" alt="{{ $siteName }}" class="oc-brand-image w-auto rounded-xl">
                        @else
                        <span class="brand-logo" aria-hidden="true"></span>
                        @endif
                        <span class="brand-text leading-none">{{ $siteName }}</span>
                    </a>
                </div>

                <form action="{{ route('listings.index') }}" method="GET" class="oc-search oc-search-main">
                    <svg class="w-5 h-5 oc-search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-4.35-4.35m1.6-5.05a7.25 7.25 0 11-14.5 0 7.25 7.25 0 0114.5 0z"/>
                    </svg>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="{{ __('messages.search_placeholder') }}"
                        class="oc-search-input"
                    >
                    <button type="submit" class="oc-search-submit">
                        {{ __('messages.search') }}
                    </button>
                </form>

                <div class="oc-actions">
                    <details class="relative oc-location" data-location-widget data-cities-url-template="{{ $citiesRouteTemplate }}">
                        <summary class="oc-pill oc-location-trigger list-none cursor-pointer">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 21s7-6.2 7-11a7 7 0 10-14 0c0 4.8 7 11 7 11z"/>
                                <circle cx="12" cy="10" r="2.3" stroke-width="1.8" />
                            </svg>
                            <span data-location-label class="oc-location-label">Choose location</span>
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 9l6 6 6-6"/>
                            </svg>
                        </summary>
                        <div class="location-panel absolute right-0 top-full mt-3 bg-white border border-slate-200 shadow-xl rounded-2xl p-4 space-y-3">
                            <div class="flex items-center justify-between gap-3">
                                <p class="text-sm font-semibold text-slate-900">Location</p>
                                <button type="button" data-location-detect class="text-xs font-semibold text-slate-600 hover:text-slate-900 transition">Use my location</button>
                            </div>
                            <p data-location-status class="text-xs text-slate-500">Auto-select country and city from your browser location.</p>
                            <div class="space-y-2">
                                <label class="block text-xs font-semibold text-slate-600">Country</label>
                                <select data-location-country class="w-full">
                                    <option value="">Select country</option>
                                    @foreach($locationCountries as $country)
                                    <option
                                        value="{{ $country['id'] }}"
                                        data-code="{{ strtoupper($country['code'] ?? '') }}"
                                        data-name="{{ $country['name'] }}"
                                        data-default="{{ strtoupper($country['code'] ?? '') === $defaultCountryIso2 ? '1' : '0' }}"
                                    >
                                        {{ $country['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-xs font-semibold text-slate-600">City</label>
                                <select data-location-city class="w-full" disabled>
                                    <option value="">Select country first</option>
                                </select>
                            </div>
                            <button type="button" data-location-save class="w-full btn-primary px-4 py-2.5 text-sm font-semibold transition">Apply</button>
                        </div>
                    </details>

                    @auth
                    <details class="oc-account-menu oc-desktop-utility">
                        <summary class="oc-account-trigger list-none cursor-pointer">
                            <span class="oc-account-name">{{ $headerAccount['name'] ?? auth()->user()->name }}</span>
                            <svg class="oc-account-chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 9l6 6 6-6"/>
                            </svg>
                        </summary>
                        <div class="oc-account-panel">
                            <a href="{{ $panelListingsRoute }}" class="oc-account-link">My Listings</a>
                            <a href="{{ $profileRoute }}" class="oc-account-link">My Profile</a>
                            <a href="{{ $favoritesRoute }}" class="oc-account-link">Favorites</a>
                            <a href="{{ $inboxRoute }}" class="oc-account-link">Inbox</a>
                            <form method="POST" action="{{ $logoutRoute }}">
                                @csrf
                                <button type="submit" class="oc-account-link oc-account-link-button">Logout</button>
                            </form>
                        </div>
                    </details>
                    <a href="{{ $inboxRoute }}" class="header-utility oc-desktop-utility oc-header-icon" aria-label="Inbox" data-header-inbox-link>
                        <span class="oc-header-badge {{ $headerMessageCount > 0 ? '' : 'hidden' }}" data-header-inbox-badge>{{ $headerBadgeLabel($headerMessageCount) }}</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16a1 1 0 011 1v10a1 1 0 01-1 1H4a1 1 0 01-1-1V7a1 1 0 011-1z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l9 6 9-6"/>
                        </svg>
                    </a>
                    <a href="{{ $notificationsRoute }}" class="header-utility oc-desktop-utility oc-header-icon" aria-label="Notifications">
                        @if($headerNotificationCount > 0)
                        <span class="oc-header-badge">{{ $headerBadgeLabel($headerNotificationCount) }}</span>
                        @endif
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 17h5l-1.4-1.4a2 2 0 0 1-.6-1.4V11a6 6 0 1 0-12 0v3.2a2 2 0 0 1-.6 1.4L4 17h5"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10 17a2 2 0 0 0 4 0"/>
                        </svg>
                    </a>
                    <a href="{{ $favoritesRoute }}" class="header-utility oc-desktop-utility oc-header-icon" aria-label="Favorites">
                        @if($headerFavoritesCount > 0)
                        <span class="oc-header-badge is-neutral">{{ $headerBadgeLabel($headerFavoritesCount) }}</span>
                        @endif
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m12 3 2.8 5.67 6.2.9-4.5 4.39 1.06 6.2L12 17.21 6.44 20.16 7.5 13.96 3 9.57l6.2-.9L12 3z"/>
                        </svg>
                    </a>
                    <a href="{{ $panelCreateRoute }}" class="btn-primary oc-cta">
                        Sell
                    </a>
                    @else
                    <a href="{{ $loginRoute }}" class="oc-text-link oc-auth-link">
                        {{ __('messages.login') }}
                    </a>
                    <a href="{{ $panelCreateRoute }}" class="btn-primary oc-cta">
                        Sell
                    </a>
                    @endauth
                </div>
            </div>

            <div class="oc-mobile-menu-shell" id="oc-mobile-menu" data-mobile-menu>
                <button type="button" class="oc-mobile-menu-backdrop" data-mobile-menu-close aria-label="Close navigation menu"></button>

                <div class="oc-mobile-menu-panel" role="dialog" aria-modal="true" aria-label="Navigation menu">
                    <div class="oc-mobile-menu-header">
                        <h2 class="oc-mobile-menu-title">Menu</h2>
                        <button type="button" class="header-utility oc-mobile-menu-close" data-mobile-menu-close aria-label="Close navigation menu">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 6l12 12M18 6L6 18"/>
                            </svg>
                        </button>
                    </div>

                    <div class="oc-mobile-menu-actions">
                        <a href="{{ route('listings.index') }}" class="oc-mobile-menu-primary">Browse</a>
                        <a href="{{ $panelCreateRoute }}" class="oc-mobile-menu-primary oc-mobile-menu-primary-strong">Sell</a>
                    </div>

                    <div class="oc-mobile-menu-section">
                        <p class="oc-mobile-menu-label">Browse</p>
                        <div class="oc-mobile-menu-list">
                            @foreach($menuBrowseLinks as $menuBrowseLink)
                            <a href="{{ $menuBrowseLink['url'] }}" class="oc-mobile-menu-link">
                                <span>{{ $menuBrowseLink['label'] }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 6l6 6-6 6"/>
                                </svg>
                            </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="oc-mobile-menu-section">
                        <p class="oc-mobile-menu-label">Account</p>
                        <div class="oc-mobile-menu-list">
                            @auth
                            <a href="{{ $panelListingsRoute }}" class="oc-mobile-menu-link">
                                <span>Dashboard</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 6l6 6-6 6"/>
                                </svg>
                            </a>
                            <a href="{{ $favoritesRoute }}" class="oc-mobile-menu-link">
                                <span>Favorites</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 6l6 6-6 6"/>
                                </svg>
                            </a>
                            <a href="{{ $inboxRoute }}" class="oc-mobile-menu-link">
                                <span>Inbox</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 6l6 6-6 6"/>
                                </svg>
                            </a>
                            @else
                            <a href="{{ $loginRoute }}" class="oc-mobile-menu-link">
                                <span>Login</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 6l6 6-6 6"/>
                                </svg>
                            </a>
                            <a href="{{ $registerRoute }}" class="oc-mobile-menu-link">
                                <span>Register</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 6l6 6-6 6"/>
                                </svg>
                            </a>
                            @endauth
                        </div>
                    </div>

                    <div class="oc-mobile-menu-section">
                        <p class="oc-mobile-menu-label">Languages</p>
                        <div class="oc-mobile-menu-languages">
                            @foreach($availableLocales as $locale)
                            <a href="{{ route('lang.switch', $locale) }}" class="oc-mobile-menu-language {{ app()->getLocale() === $locale ? 'is-active' : '' }}">
                                {{ $localeLabels[$locale] ?? strtoupper($locale) }}
                            </a>
                            @endforeach
                        </div>
                    </div>

                    @auth
                    <form method="POST" action="{{ $logoutRoute }}" class="oc-mobile-menu-logout">
                        @csrf
                        <button type="submit" class="oc-mobile-menu-logout-btn">Logout</button>
                    </form>
                    @endif
                </div>
            </div>

            <div class="oc-category-row" data-anim-header-row>
                <div class="oc-category-track">
                    <a href="{{ route('categories.index') }}" class="oc-category-pill">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <span>All Categories</span>
                    </a>
                    @forelse($headerCategories as $headerCategory)
                    <a href="{{ route('listings.index', ['category' => $headerCategory['id']]) }}" class="oc-category-link">
                        @if(! empty($headerCategory['icon_url']))
                        <span class="oc-category-link-icon">
                            <img src="{{ $headerCategory['icon_url'] }}" alt="{{ $headerCategory['name'] }}">
                        </span>
                        @endif
                        {{ $headerCategory['name'] }}
                    </a>
                    @empty
                    <a href="{{ route('home') }}" class="oc-category-link">{{ __('messages.home') }}</a>
                    <a href="{{ route('listings.index') }}" class="oc-category-link">{{ __('messages.listings') }}</a>
                    @endforelse
                </div>
            </div>
        </div>
    </nav>
    @endif
    @endif
    @if($demoRemainingLabel)
    <div class="pointer-events-none fixed bottom-4 right-4 z-40">
        <div class="rounded-full border border-amber-200 bg-white/95 px-3 py-1.5 text-[11px] font-semibold text-amber-900 shadow-lg backdrop-blur">
            Demo: {{ $demoRemainingCompactLabel }} left
        </div>
    </div>
    @endif
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
    <main @class([
        'site-main',
        'min-h-screen' => $demoLandingMode,
    ])>@yield('content')</main>
    @if(!$simplePage && ! $demoLandingMode)
    <footer class="mt-10 md:mt-14 bg-slate-100 text-slate-600 border-t border-slate-200" data-anim-footer>
        <div class="max-w-[1320px] mx-auto px-4 py-8 md:py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 md:gap-8">
                <div data-anim-footer-item>
                    <h3 class="text-slate-900 font-semibold text-lg mb-3">{{ $siteName }}</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">{{ $siteDescription }}</p>
                </div>
                <div data-anim-footer-item>
                    <h4 class="text-slate-900 font-medium mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-slate-900 transition">Home</a></li>
                        <li><a href="{{ route('categories.index') }}" class="hover:text-slate-900 transition">Categories</a></li>
                        <li><a href="{{ route('listings.index') }}" class="hover:text-slate-900 transition">All Listings</a></li>
                    </ul>
                </div>
                <div data-anim-footer-item>
                    <h4 class="text-slate-900 font-medium mb-4">Account</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ $loginRoute }}" class="hover:text-slate-900 transition">{{ __('messages.login') }}</a></li>
                        <li><a href="{{ $registerRoute }}" class="hover:text-slate-900 transition">{{ __('messages.register') }}</a></li>
                    </ul>
                </div>
                <div data-anim-footer-item>
                    <h4 class="text-slate-900 font-medium mb-4">Links</h4>
                    <ul class="space-y-2 text-sm mb-3 md:mb-4">
                        @if($linkedinUrl)
                        <li><a href="{{ $linkedinUrl }}" target="_blank" rel="noopener" class="hover:text-slate-900 transition">LinkedIn</a></li>
                        @endif
                        @if($instagramUrl)
                        <li><a href="{{ $instagramUrl }}" target="_blank" rel="noopener" class="hover:text-slate-900 transition">Instagram</a></li>
                        @endif
                        @if($whatsappUrl)
                        <li><a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" class="hover:text-slate-900 transition">WhatsApp</a></li>
                        @endif
                        @if(!$linkedinUrl && !$instagramUrl && !$whatsappUrl)
                        <li>No social links added yet.</li>
                        @endif
                    </ul>
                    <h4 class="text-slate-900 font-medium mb-3">Languages</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach($availableLocales as $locale)
                        <a href="{{ route('lang.switch', $locale) }}" class="text-xs {{ app()->getLocale() === $locale ? 'text-slate-900' : 'hover:text-slate-900' }} transition">{{ strtoupper($locale) }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="border-t border-slate-300 mt-6 md:mt-8 pt-6 md:pt-8 text-center text-sm text-slate-500">
                <p>© {{ date('Y') }} {{ $siteName }}. All rights reserved.</p>
            </div>
        </div>
    </footer>
    @endif
    @livewireScripts
    <script>
        (() => {
            const widgetRoots = Array.from(document.querySelectorAll('[data-location-widget]'));
            const storageKey = 'oc2.header.location';

            if (widgetRoots.length === 0) {
                return;
            }

            const normalize = (value) => (value ?? '')
                .toString()
                .toLocaleLowerCase('tr-TR')
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .trim();

            const readStored = () => {
                try {
                    const raw = localStorage.getItem(storageKey);
                    if (!raw) {
                        return null;
                    }

                    return JSON.parse(raw);
                } catch (error) {
                    return null;
                }
            };

            const writeStored = (value) => {
                localStorage.setItem(storageKey, JSON.stringify(value));
            };

            const formatLocationLabel = (location) => {
                if (!location || typeof location !== 'object') {
                    return 'Choose location';
                }

                const cityName = (location.cityName ?? '').toString().trim();
                const countryName = (location.countryName ?? '').toString().trim();

                if (cityName && countryName) {
                    return cityName + ', ' + countryName;
                }

                if (countryName) {
                    return countryName;
                }

                return 'Choose location';
            };

            const updateLabels = (location) => {
                const label = formatLocationLabel(location);
                widgetRoots.forEach((root) => {
                    const target = root.querySelector('[data-location-label]');
                    if (target) {
                        target.textContent = label;
                    }
                });
            };

            const fetchCityOptions = async (url) => {
                const response = await fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                });

                if (!response.ok) {
                    throw new Error('city_fetch_failed');
                }

                const payload = await response.json();

                if (Array.isArray(payload)) {
                    return payload;
                }

                return Array.isArray(payload?.data) ? payload.data : [];
            };

            const buildCitiesUrl = (template, countryId) => {
                const normalizedTemplate = (template ?? '').toString().trim();
                const normalizedCountryId = (countryId ?? '').toString().trim();
                const encodedCountryId = encodeURIComponent(normalizedCountryId);

                if (normalizedTemplate === '' || normalizedCountryId === '') {
                    return '';
                }

                if (normalizedTemplate.includes('__COUNTRY__')) {
                    return normalizedTemplate.replace('__COUNTRY__', encodedCountryId);
                }

                return normalizedTemplate.endsWith('/')
                    ? normalizedTemplate + encodedCountryId
                    : `${normalizedTemplate}/${encodedCountryId}`;
            };

            const loadCities = async (root, countryId, selectedCityId = null, selectedCityName = null) => {
                const citySelect = root.querySelector('[data-location-city]');
                const countrySelect = root.querySelector('[data-location-country]');
                const statusText = root.querySelector('[data-location-status]');
                const template = root.dataset.citiesUrlTemplate ?? '';
                const normalizedCountryId = (countryId ?? '').toString().trim();

                if (!citySelect || !countrySelect) {
                    return;
                }

                if (normalizedCountryId === '' || template === '') {
                    citySelect.innerHTML = '<option value="">Select country first</option>';
                    citySelect.disabled = true;
                    return;
                }

                citySelect.disabled = true;
                citySelect.innerHTML = '<option value="">Loading cities...</option>';

                try {
                    const primaryUrl = buildCitiesUrl(template, normalizedCountryId);

                    if (primaryUrl === '') {
                        throw new Error('city_url_invalid');
                    }

                    let cityOptions;

                    try {
                        cityOptions = await fetchCityOptions(primaryUrl);
                    } catch (primaryError) {
                        if (!/^https?:\/\//i.test(primaryUrl)) {
                            throw primaryError;
                        }

                        let fallbackUrl = null;

                        try {
                            const parsed = new URL(primaryUrl);
                            fallbackUrl = `${parsed.pathname}${parsed.search}`;
                        } catch (urlError) {
                            fallbackUrl = null;
                        }

                        if (!fallbackUrl) {
                            throw primaryError;
                        }

                        cityOptions = await fetchCityOptions(fallbackUrl);
                    }

                    citySelect.innerHTML = '<option value="">Select city</option>';

                    if (cityOptions.length === 0) {
                        citySelect.innerHTML = '<option value="">No cities found</option>';
                        citySelect.disabled = true;
                        return;
                    }

                    cityOptions.forEach((city) => {
                        const option = document.createElement('option');
                        option.value = String(city.id ?? '');
                        option.textContent = city.name ?? '';
                        option.dataset.name = city.name ?? '';
                        citySelect.appendChild(option);
                    });

                    citySelect.disabled = false;

                    if (selectedCityId) {
                        citySelect.value = String(selectedCityId);
                    } else if (selectedCityName) {
                        const matched = Array.from(citySelect.options).find((option) => normalize(option.dataset.name) === normalize(selectedCityName));
                        if (matched) {
                            citySelect.value = matched.value;
                        }
                    }
                } catch (error) {
                    citySelect.innerHTML = '<option value="">Could not load cities</option>';
                    citySelect.disabled = true;
                    if (statusText) {
                        statusText.textContent = 'Could not load the city list. Please try again.';
                    }
                }
            };

            const findMatchingCityOption = (citySelect, candidates) => {
                const normalizedCandidates = candidates
                    .map((candidate) => normalize(candidate))
                    .filter((candidate) => candidate !== '');

                if (normalizedCandidates.length === 0) {
                    return null;
                }

                const options = Array.from(citySelect.options).filter((option) => option.value !== '');

                for (const candidate of normalizedCandidates) {
                    const exactMatch = options.find((option) => normalize(option.dataset.name || option.textContent) === candidate);

                    if (exactMatch) {
                        return exactMatch;
                    }
                }

                for (const candidate of normalizedCandidates) {
                    const containsMatch = options.find((option) => {
                        const optionName = normalize(option.dataset.name || option.textContent);

                        return optionName.includes(candidate) || candidate.includes(optionName);
                    });

                    if (containsMatch) {
                        return containsMatch;
                    }
                }

                return null;
            };

            const saveFromInputs = (root, extra = {}) => {
                const countrySelect = root.querySelector('[data-location-country]');
                const citySelect = root.querySelector('[data-location-city]');
                const details = root.closest('details');

                if (!countrySelect || !citySelect || !countrySelect.value) {
                    return false;
                }

                const countryOption = countrySelect.options[countrySelect.selectedIndex];
                const cityOption = citySelect.options[citySelect.selectedIndex];
                const hasCitySelection = citySelect.value !== '';

                const location = {
                    countryId: Number(countrySelect.value),
                    countryName: countryOption?.dataset.name ?? countryOption?.textContent ?? '',
                    countryCode: (countryOption?.dataset.code ?? '').toUpperCase(),
                    cityId: hasCitySelection ? Number(citySelect.value) : null,
                    cityName: hasCitySelection ? (cityOption?.dataset.name ?? cityOption?.textContent ?? '') : '',
                    updatedAt: new Date().toISOString(),
                    ...extra,
                };

                writeStored(location);
                updateLabels(location);

                if (details && details.hasAttribute('open')) {
                    details.removeAttribute('open');
                }

                return true;
            };

            const reverseLookup = async (latitude, longitude) => {
                const language = (document.documentElement.lang || 'tr').split('-')[0];
                const url = new URL('https://nominatim.openstreetmap.org/reverse');
                url.searchParams.set('format', 'jsonv2');
                url.searchParams.set('lat', String(latitude));
                url.searchParams.set('lon', String(longitude));
                url.searchParams.set('accept-language', language);

                const response = await fetch(url.toString(), {
                    headers: {
                        'Accept': 'application/json',
                    },
                });

                if (!response.ok) {
                    throw new Error('reverse_lookup_failed');
                }

                const payload = await response.json();
                const address = payload.address ?? {};

                return {
                    countryCode: (address.country_code ?? '').toUpperCase(),
                    countryName: address.country ?? '',
                    cityName: address.city ?? address.town ?? address.village ?? address.municipality ?? '',
                    regionName: address.state ?? address.province ?? '',
                    districtName: address.state_district ?? address.county ?? '',
                };
            };

            const geolocationPosition = () => new Promise((resolve, reject) => {
                if (!window.isSecureContext) {
                    reject(new Error('secure_context_required'));
                    return;
                }

                if (!('geolocation' in navigator)) {
                    reject(new Error('geolocation_not_supported'));
                    return;
                }

                navigator.geolocation.getCurrentPosition(resolve, reject, {
                    enableHighAccuracy: true,
                    timeout: 15000,
                    maximumAge: 120000,
                });
            });

            updateLabels(readStored());

            widgetRoots.forEach((root) => {
                const countrySelect = root.querySelector('[data-location-country]');
                const citySelect = root.querySelector('[data-location-city]');
                const saveButton = root.querySelector('[data-location-save]');
                const detectButton = root.querySelector('[data-location-detect]');
                const statusText = root.querySelector('[data-location-status]');
                const stored = readStored();

                if (!countrySelect || !citySelect || !saveButton) {
                    return;
                }

                const applyStored = async () => {
                    if (stored && typeof stored === 'object') {
                        const matchedStoredCountry = Array.from(countrySelect.options).find((option) => {
                            if (stored.countryId && option.value === String(stored.countryId)) {
                                return true;
                            }

                            if (stored.countryCode && option.dataset.code === String(stored.countryCode).toUpperCase()) {
                                return true;
                            }

                            if (stored.countryName) {
                                return normalize(option.dataset.name) === normalize(stored.countryName);
                            }

                            return false;
                        });

                        if (matchedStoredCountry) {
                            countrySelect.value = matchedStoredCountry.value;
                            await loadCities(root, matchedStoredCountry.value, stored.cityId, stored.cityName);
                            return;
                        }
                    }

                    const defaultOption = Array.from(countrySelect.options).find((option) => option.dataset.default === '1');
                    if (defaultOption) {
                        countrySelect.value = defaultOption.value;
                        await loadCities(root, defaultOption.value, null, null);
                    }
                };

                void applyStored();

                countrySelect.addEventListener('change', async () => {
                    if (statusText) {
                        statusText.textContent = 'Updating cities for the selected country...';
                    }
                    await loadCities(root, countrySelect.value, null, null);
                    if (statusText) {
                        statusText.textContent = 'Select a city and apply.';
                    }
                });

                saveButton.addEventListener('click', () => {
                    const saved = saveFromInputs(root);

                    if (saved && statusText) {
                        statusText.textContent = 'Location saved.';
                    }
                });

                if (detectButton) {
                    detectButton.addEventListener('click', async () => {
                        if (statusText) {
                            statusText.textContent = 'Getting your location...';
                        }

                        try {
                            const position = await geolocationPosition();
                            const latitude = position.coords.latitude;
                            const longitude = position.coords.longitude;
                            const guessed = await reverseLookup(latitude, longitude);

                            let matchedCountry = Array.from(countrySelect.options).find((option) => option.dataset.code === guessed.countryCode);

                            if (!matchedCountry && guessed.countryName) {
                                matchedCountry = Array.from(countrySelect.options).find((option) => normalize(option.dataset.name) === normalize(guessed.countryName));
                            }

                            if (!matchedCountry) {
                                if (statusText) {
                                    statusText.textContent = 'No matching country found. Please choose it manually.';
                                }
                                return;
                            }

                            countrySelect.value = matchedCountry.value;
                            await loadCities(root, matchedCountry.value, null, null);

                            const matchedCity = findMatchingCityOption(citySelect, [
                                guessed.cityName,
                                guessed.regionName,
                                guessed.districtName,
                            ]);

                            if (matchedCity) {
                                citySelect.value = matchedCity.value;
                            }

                            if (!matchedCity && !citySelect.disabled && citySelect.options.length > 1) {
                                if (statusText) {
                                    const returnedCity = guessed.cityName || guessed.regionName || guessed.districtName;
                                    statusText.textContent = returnedCity
                                        ? `Country was selected, but the returned city "${returnedCity}" could not be matched automatically. Please choose your city.`
                                        : 'Country was selected, but the city could not be matched automatically. Please choose your city.';
                                }

                                const details = root.closest('details');
                                if (details) {
                                    details.setAttribute('open', 'open');
                                }

                                return;
                            }

                            const saved = saveFromInputs(root, { latitude, longitude });

                            if (saved && statusText) {
                                statusText.textContent = 'Location selected automatically.';
                            }
                        } catch (error) {
                            if (statusText) {
                                statusText.textContent = error?.message === 'secure_context_required'
                                    ? 'HTTPS is required for browser location. Open the site over a secure connection.'
                                    : 'Could not access location. Check your browser permissions.';
                            }
                        }
                    });
                }
            });
        })();

        (() => {
            const menu = document.querySelector('[data-mobile-menu]');
            const openButtons = Array.from(document.querySelectorAll('[data-mobile-menu-open]'));
            const closeButtons = Array.from(document.querySelectorAll('[data-mobile-menu-close]'));

            if (!menu || openButtons.length === 0) {
                return;
            }

            const setOpen = (shouldOpen) => {
                menu.classList.toggle('is-open', shouldOpen);
                document.documentElement.classList.toggle('oc-menu-open', shouldOpen);
                document.body.style.overflow = shouldOpen ? 'hidden' : '';

                openButtons.forEach((button) => {
                    button.setAttribute('aria-expanded', shouldOpen ? 'true' : 'false');
                });

                if (shouldOpen) {
                    document.querySelectorAll('[data-location-widget][open]').forEach((details) => {
                        details.removeAttribute('open');
                    });
                }
            };

            openButtons.forEach((button) => {
                button.addEventListener('click', () => setOpen(true));
            });

            closeButtons.forEach((button) => {
                button.addEventListener('click', () => setOpen(false));
            });

            menu.querySelectorAll('a').forEach((link) => {
                link.addEventListener('click', () => setOpen(false));
            });

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    setOpen(false);
                }
            });

            window.addEventListener('resize', () => {
                if (window.innerWidth >= 1024) {
                    setOpen(false);
                }
            });
        })();
    </script>
    <x-impersonate::banner />
</body>
</html>
