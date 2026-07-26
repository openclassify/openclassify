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
    <nav class="sticky top-0 z-50 border-b border-black/5 bg-white/80">
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
                <a href="{{ route('panel.listings.index') }}" class="inline-flex min-h-11 items-center justify-center rounded-full border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-700 hover:border-slate-300 hover:text-slate-900">
                    My Listings
                </a>
                @endauth
                <a href="{{ route('home') }}" class="inline-flex min-h-11 items-center justify-center rounded-full bg-slate-900 px-5 text-sm font-semibold text-white hover:bg-slate-700">
                    Exit
                </a>
            </div>
        </div>
    </nav>
    @else
    <nav class="market-nav-surface sticky top-0 z-50">
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
                        <div class="location-panel absolute right-0 top-full mt-3 bg-white border border-slate-200 rounded-2xl p-4 space-y-3">
                            <div class="flex items-center justify-between gap-3">
                                <p class="text-sm font-semibold text-slate-900">Location</p>
                                <button type="button" data-location-detect class="text-xs font-semibold text-slate-600 hover:text-slate-900">Use my location</button>
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
                            <button type="button" data-location-save class="w-full btn-primary px-4 py-2.5 text-sm font-semibold">Apply</button>
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

            <div class="oc-category-row">
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
        <div class="rounded-full border border-amber-200 bg-white px-3 py-1.5 text-[11px] font-semibold text-amber-900">
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
    <footer class="mt-10 md:mt-14 bg-slate-100 text-slate-600 border-t border-slate-200">
        <div class="max-w-[1320px] mx-auto px-4 py-8 md:py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 md:gap-8">
                <div>
                    <h3 class="text-slate-900 font-semibold text-lg mb-3">{{ $siteName }}</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">{{ $siteDescription }}</p>
                </div>
                <div>
                    <h4 class="text-slate-900 font-medium mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-slate-900">Home</a></li>
                        <li><a href="{{ route('categories.index') }}" class="hover:text-slate-900">Categories</a></li>
                        <li><a href="{{ route('listings.index') }}" class="hover:text-slate-900">All Listings</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-slate-900 font-medium mb-4">Account</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ $loginRoute }}" class="hover:text-slate-900">{{ __('messages.login') }}</a></li>
                        <li><a href="{{ $registerRoute }}" class="hover:text-slate-900">{{ __('messages.register') }}</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-slate-900 font-medium mb-4">Links</h4>
                    <ul class="space-y-2 text-sm mb-3 md:mb-4">
                        @if($linkedinUrl)
                        <li><a href="{{ $linkedinUrl }}" target="_blank" rel="noopener" class="hover:text-slate-900">LinkedIn</a></li>
                        @endif
                        @if($instagramUrl)
                        <li><a href="{{ $instagramUrl }}" target="_blank" rel="noopener" class="hover:text-slate-900">Instagram</a></li>
                        @endif
                        @if($whatsappUrl)
                        <li><a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" class="hover:text-slate-900">WhatsApp</a></li>
                        @endif
                        @if(!$linkedinUrl && !$instagramUrl && !$whatsappUrl)
                        <li>No social links added yet.</li>
                        @endif
                    </ul>
                    <h4 class="text-slate-900 font-medium mb-3">Languages</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach($availableLocales as $locale)
                        <a href="{{ route('lang.switch', $locale) }}" class="text-xs {{ app()->getLocale() === $locale ? 'text-slate-900' : 'hover:text-slate-900' }}">{{ strtoupper($locale) }}</a>
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
    <x-impersonate::banner />
</body>
</html>
