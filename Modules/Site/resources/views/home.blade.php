@extends('app::layouts.app')
@section('content')
@php
    $menuCategories = $categories->take(8);
    $heroListing = $featuredListings->first() ?? $recentListings->first();
    $heroImage = $heroListing?->primaryImageData('gallery');
    $listingCards = $recentListings->take(6);
    $demoEnabled = (bool) config('demo.enabled');
    $prepareDemoRoute = $demoEnabled ? route('demo.prepare') : null;
    $prepareDemoRedirect = url()->full();
    $hasDemoSession = (bool) session('is_demo_session') || filled(session('demo_uuid'));
    $demoLandingMode = $demoEnabled && !auth()->check() && !$hasDemoSession;
    $demoTurnstileProtectionEnabled = (bool) config('demo.turnstile.enabled', false);
    $demoTurnstileSiteKey = trim((string) config('demo.turnstile.site_key', ''));
    $prepareDemoTurnstileRequired = $demoLandingMode && $demoTurnstileProtectionEnabled;
    $prepareDemoTurnstileRenderable = $prepareDemoTurnstileRequired && $demoTurnstileSiteKey !== '';
    $demoTtlMinutes = (int) config('demo.ttl_minutes', 360);
    $demoTtlHours = intdiv($demoTtlMinutes, 60);
    $demoTtlRemainderMinutes = $demoTtlMinutes % 60;
    $demoTtlLabelParts = [];

    if ($demoTtlHours > 0) {
        $demoTtlLabelParts[] = $demoTtlHours.' '.\Illuminate\Support\Str::plural('hour', $demoTtlHours);
    }

    if ($demoTtlRemainderMinutes > 0) {
        $demoTtlLabelParts[] = $demoTtlRemainderMinutes.' '.\Illuminate\Support\Str::plural('minute', $demoTtlRemainderMinutes);
    }

    $demoTtlLabel = $demoTtlLabelParts !== [] ? implode(' ', $demoTtlLabelParts) : '0 minutes';
    $homeSlides = collect($generalSettings['home_slides'] ?? [])
        ->filter(fn ($slide): bool => is_array($slide))
        ->map(function (array $slide): array {
            $badge = trim((string) ($slide['badge'] ?? ''));
            $title = trim((string) ($slide['title'] ?? ''));
            $subtitle = trim((string) ($slide['subtitle'] ?? ''));
            $primaryButtonText = trim((string) ($slide['primary_button_text'] ?? ''));
            $secondaryButtonText = trim((string) ($slide['secondary_button_text'] ?? ''));
            $imagePath = trim((string) ($slide['image_path'] ?? ''));

            return [
                'badge' => $badge !== '' ? $badge : 'OpenClassify Marketplace',
                'title' => $title !== '' ? $title : 'Sell faster with a cleaner local marketplace.',
                'subtitle' => $subtitle !== '' ? $subtitle : 'Buy and sell everything in your area',
                'primary_button_text' => $primaryButtonText !== '' ? $primaryButtonText : 'Browse Listings',
                'secondary_button_text' => $secondaryButtonText !== '' ? $secondaryButtonText : 'Post Listing',
                'image_url' => \Modules\Site\App\Support\LocalMedia::url($imagePath),
            ];
        })
        ->values();

    if ($homeSlides->isEmpty()) {
        $homeSlides = collect([
            [
                'badge' => 'OpenClassify Marketplace',
                'title' => 'Sell faster with a cleaner local marketplace.',
                'subtitle' => 'Buy and sell everything in your area',
                'primary_button_text' => 'Browse Listings',
                'secondary_button_text' => 'Post Listing',
                'image_url' => null,
            ],
        ]);
    }

@endphp

@if($demoLandingMode && $prepareDemoRoute)
<div class="min-h-screen flex items-center justify-center px-5 py-10">
    <form method="POST" action="{{ $prepareDemoRoute }}" data-demo-prepare-form data-turnstile-required="{{ $prepareDemoTurnstileRequired ? '1' : '0' }}" class="w-full max-w-xl rounded-[32px] border border-slate-200 bg-white p-8 md:p-10 shadow-xl">
        @csrf
        <input type="hidden" name="redirect_to" value="{{ $prepareDemoRedirect }}">
        <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight text-slate-950">Prepare Demo</h1>
        <p class="mt-5 text-base md:text-lg leading-8 text-slate-600">
            Launch a private seeded marketplace for this browser. Listings, favorites, inbox data, and admin access are prepared automatically.
        </p>
        <p class="mt-4 text-base text-slate-500">
            This demo is deleted automatically after {{ $demoTtlLabel }}.
        </p>
        @if($prepareDemoTurnstileRenderable)
        <div class="mt-6 space-y-2">
            <div class="cf-turnstile" data-sitekey="{{ $demoTurnstileSiteKey }}"></div>
            <p class="text-xs text-slate-500">Complete the security check before starting your private demo.</p>
        </div>
        @elseif($prepareDemoTurnstileRequired)
        <p class="mt-6 rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm font-medium leading-6 text-amber-700">
            Security check is enabled but the widget is not configured. Contact the administrator.
        </p>
        @endif
        <p data-demo-prepare-status data-turnstile-message="Please complete the security verification first." data-loading-message="Preparing your private demo. This can take longer because a dedicated seeded environment is being provisioned for your browser." aria-live="polite" class="mt-4 hidden rounded-2xl border border-blue-200 bg-blue-50 px-4 py-3 text-sm font-medium leading-6 text-blue-800">
            Preparing your private demo. This can take longer because a dedicated seeded environment is being provisioned for your browser.
        </p>
        <button type="submit" data-demo-prepare-button @if($prepareDemoTurnstileRequired) disabled @endif class="mt-8 inline-flex min-h-16 w-full items-center justify-center rounded-full bg-blue-600 px-8 py-4 text-lg font-semibold text-white shadow-lg transition hover:bg-blue-700 disabled:cursor-not-allowed disabled:bg-blue-500">
            <span data-demo-prepare-idle>Prepare Demo</span>
            <span data-demo-prepare-loading class="hidden items-center gap-2">
                <svg class="h-5 w-5 animate-spin" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"></circle>
                    <path class="opacity-90" fill="currentColor" d="M4 12a8 8 0 0 1 8-8v3a5 5 0 0 0-5 5H4z"></path>
                </svg>
                Preparing Demo...
            </span>
        </button>
    </form>
</div>
@else
<div class="max-w-[1320px] mx-auto px-3 py-4 md:px-4 md:py-7 space-y-5 md:space-y-7">
    <section class="relative overflow-hidden rounded-[24px] md:rounded-[28px] bg-gradient-to-r from-blue-900 via-blue-700 to-blue-600 text-white shadow-xl" data-home-hero>
        <div class="absolute -top-20 -left-24 w-80 h-80 rounded-full bg-blue-400/20 blur-3xl"></div>
        <div class="absolute -bottom-24 right-10 w-80 h-80 rounded-full bg-cyan-300/20 blur-3xl"></div>
        <div class="relative grid lg:grid-cols-[1fr,1.1fr] gap-4 md:gap-6 items-center px-5 md:px-12 py-6 md:py-14">
            <div data-home-slider data-home-hero-copy>
                <div class="relative min-h-[210px] md:min-h-[250px]">
                    @foreach($homeSlides as $index => $slide)
                    <div
                        data-home-slide
                        @class(['transition-opacity duration-300', 'hidden' => $index !== 0])
                        aria-hidden="{{ $index === 0 ? 'false' : 'true' }}"
                    >
                        <p class="text-[10px] md:text-sm uppercase tracking-[0.22em] text-blue-200 font-semibold mb-3 md:mb-4">{{ $slide['badge'] }}</p>
                        <h1 class="text-[1.85rem] md:text-5xl leading-[1.1] font-extrabold max-w-xl">{{ $slide['title'] }}</h1>
                        <p class="mt-3 md:mt-4 text-blue-100 text-[13px] md:text-lg max-w-xl leading-6 md:leading-8">{{ $slide['subtitle'] }}</p>
                        <div class="mt-6 md:mt-8 flex flex-wrap items-center gap-2 md:gap-3">
                            <a href="{{ route('listings.index') }}" class="bg-white text-blue-900 px-5 md:px-8 py-2.5 md:py-3 rounded-full text-sm md:text-base font-semibold hover:bg-blue-50 transition">
                                {{ $slide['primary_button_text'] }}
                            </a>
                            @auth
                            <a href="{{ route('panel.listings.create') }}" class="border border-blue-200/60 px-5 md:px-8 py-2.5 md:py-3 rounded-full text-sm md:text-base font-semibold hover:bg-white/10 transition">
                                {{ $slide['secondary_button_text'] }}
                            </a>
                            @else
                            <a href="{{ route('login') }}" class="border border-blue-200/60 px-5 md:px-8 py-2.5 md:py-3 rounded-full text-sm md:text-base font-semibold hover:bg-white/10 transition">
                                {{ $slide['secondary_button_text'] }}
                            </a>
                            @endauth
                        </div>
                    </div>
                    @endforeach
                </div>

                @if($homeSlides->count() > 1)
                <div class="mt-5 md:mt-8 flex items-center gap-2">
                    <button
                        type="button"
                        data-home-slide-prev
                        class="w-7 h-7 md:w-8 md:h-8 rounded-full border border-white/45 text-white grid place-items-center hover:bg-white/15 transition"
                        aria-label="Previous slide"
                    >
                        <span aria-hidden="true">‹</span>
                    </button>
                    @foreach($homeSlides as $index => $slide)
                    <button
                        type="button"
                        data-home-slide-dot="{{ $index }}"
                        @class([
                            'h-2.5 rounded-full transition-all',
                            'w-7 bg-white' => $index === 0,
                            'w-2.5 bg-white/40 hover:bg-white/60' => $index !== 0,
                        ])
                        aria-label="Slide {{ $index + 1 }}"
                    ></button>
                    @endforeach
                    <button
                        type="button"
                        data-home-slide-next
                        class="w-7 h-7 md:w-8 md:h-8 rounded-full border border-white/45 text-white grid place-items-center hover:bg-white/15 transition"
                        aria-label="Next slide"
                    >
                        <span aria-hidden="true">›</span>
                    </button>
                </div>
                @else
                <div class="mt-8 flex items-center gap-2">
                    <span class="w-7 h-2.5 rounded-full bg-white"></span>
                </div>
                @endif
            </div>
            <div class="hidden lg:block relative h-[360px]" data-home-hero-visual>
                <div class="absolute left-3 md:left-10 bottom-0 w-24 md:w-40 h-[170px] md:h-[300px] bg-slate-950 rounded-[24px] md:rounded-[32px] shadow-2xl p-2 rotate-[-8deg]">
                    <div class="w-full h-full rounded-[24px] bg-white overflow-hidden">
                        <div class="px-3 py-2 border-b border-slate-100">
                            <p class="text-rose-500 text-sm font-bold">OpenClassify</p>
                            <p class="text-[10px] text-slate-400 mt-1">Search listings, categories, and sellers</p>
                        </div>
                        <div class="p-2 space-y-2">
                            <div class="h-10 rounded-xl bg-slate-100"></div>
                            <div class="grid grid-cols-3 gap-2">
                                <div class="h-9 rounded-lg bg-blue-100"></div>
                                <div class="h-9 rounded-lg bg-emerald-100"></div>
                                <div class="h-9 rounded-lg bg-amber-100"></div>
                            </div>
                            <div class="space-y-2">
                                <div class="h-14 rounded-xl bg-slate-100"></div>
                                <div class="h-14 rounded-xl bg-slate-100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="absolute right-0 bottom-0 w-[82%] md:w-[78%] h-[86%] md:h-[88%] rounded-[24px] md:rounded-[28px] bg-gradient-to-br from-white/20 to-blue-500/40 border border-white/20 shadow-2xl flex items-end justify-center p-3 md:p-4 overflow-hidden">
                    @foreach($homeSlides as $index => $slide)
                    <div
                        data-home-slide-visual
                        @class(['absolute inset-3 md:inset-4 transition-opacity duration-300', 'hidden' => $index !== 0])
                        aria-hidden="{{ $index === 0 ? 'false' : 'true' }}"
                    >
                        @if($slide['image_url'])
                        <img src="{{ $slide['image_url'] }}" alt="{{ $slide['title'] }}" class="w-full h-full object-cover rounded-2xl">
                        @elseif($heroImage)
                        @include('listing::partials.responsive-image', [
                            'image' => $heroImage,
                            'alt' => $heroListing?->title,
                            'class' => 'w-full h-full object-cover rounded-2xl',
                            'loading' => 'eager',
                            'fetchpriority' => 'high',
                        ])
                        @else
                        <div class="w-full h-full rounded-2xl bg-white/90 text-slate-800 flex flex-col justify-center items-center gap-3">
                            <span class="text-6xl">◌</span>
                            <p class="text-sm font-semibold px-4 text-center">Upload a slide image to make this area feel complete.</p>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section data-home-section>
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-[1.35rem] md:text-3xl font-extrabold tracking-tight text-slate-900">Trending Categories</h2>
            <a href="{{ route('categories.index') }}" class="inline-flex text-sm font-semibold text-rose-500 hover:text-rose-600 transition">
                View all
            </a>
        </div>
        <div class="grid grid-cols-4 gap-3 sm:hidden">
            @foreach($menuCategories as $category)
            @php
                $categoryIconUrl = $category->iconUrl();
                $fallbackLabel = strtoupper(\Illuminate\Support\Str::substr($category->name, 0, 1));
            @endphp
            <a href="{{ route('listings.index', ['category' => $category->id]) }}" class="flex flex-col items-center gap-2 text-center">
                <span class="flex h-16 w-16 items-center justify-center rounded-full bg-white border border-slate-200 shadow-sm">
                    @if($categoryIconUrl)
                        <img src="{{ $categoryIconUrl }}" alt="{{ $category->name }}" class="h-9 w-9 object-contain">
                    @else
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-slate-100 text-sm font-semibold text-slate-700">{{ $fallbackLabel }}</span>
                    @endif
                </span>
                <span class="text-[11px] leading-4 font-semibold text-slate-800">{{ $category->name }}</span>
            </a>
            @endforeach
        </div>
        <div class="relative hidden sm:block">
            <button
                type="button"
                data-trend-prev
                class="hidden lg:inline-flex absolute left-0 top-1/2 -translate-x-1/2 -translate-y-1/2 z-10 w-11 h-11 rounded-full border border-slate-300 bg-white text-slate-700 items-center justify-center shadow-sm hover:bg-slate-50 transition"
                aria-label="Previous trending category"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 18-6-6 6-6"/>
                </svg>
            </button>
            <div data-trend-track class="flex items-stretch gap-2 overflow-x-auto pb-2 pr-1 scroll-smooth snap-x snap-mandatory [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
            @foreach($menuCategories as $index => $category)
            @php
                $categoryIconUrl = $category->iconUrl();
                $fallbackLabel = strtoupper(\Illuminate\Support\Str::substr($category->name, 0, 1));
            @endphp
            <a href="{{ route('listings.index', ['category' => $category->id]) }}" class="group shrink-0 w-[170px] rounded-[22px] overflow-hidden border border-slate-200/80 bg-white/95 p-4 hover:-translate-y-0.5 hover:shadow-[0_18px_36px_rgba(15,23,42,0.08)] transition snap-start" data-home-category-card>
                <div class="flex items-center justify-center h-[92px] rounded-[20px] bg-[linear-gradient(180deg,#f8fbff_0%,#eef5ff_100%)]">
                    @if($categoryIconUrl)
                        <img src="{{ $categoryIconUrl }}" alt="{{ $category->name }}" class="h-14 w-14 object-contain">
                    @else
                        <span class="inline-flex h-14 w-14 items-center justify-center rounded-full bg-white text-xl font-semibold text-slate-700 shadow-sm">{{ $fallbackLabel }}</span>
                    @endif
                </div>
                <div class="pt-4">
                    <p class="text-[13px] sm:text-[14px] font-semibold text-slate-900 leading-tight">{{ $category->name }}</p>
                </div>
            </a>
            @endforeach
            </div>
            <button
                type="button"
                data-trend-next
                class="hidden lg:inline-flex absolute right-0 top-1/2 translate-x-1/2 -translate-y-1/2 z-10 w-11 h-11 rounded-full border border-slate-300 bg-white text-slate-700 items-center justify-center shadow-sm hover:bg-slate-50 transition"
                aria-label="Next trending category"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 18 6-6-6-6"/>
                </svg>
            </button>
        </div>
    </section>

    <section data-home-section>
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-[1.35rem] md:text-2xl font-bold text-slate-900">Popular Listings</h2>
            <div class="hidden sm:flex items-center gap-2 text-sm text-slate-500">
                <span class="w-8 h-8 rounded-full border border-slate-300 grid place-items-center">‹</span>
                <span class="w-8 h-8 rounded-full border border-slate-300 grid place-items-center">›</span>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 md:gap-4">
            @forelse($listingCards as $listing)
            @php
                $listingImage = $listing->primaryImageData('card');
                $priceLabel = $listing->price ? number_format((float) $listing->price, 0).' '.$listing->currency : __('messages.free');
                $locationLabel = trim(collect([$listing->city, $listing->country])->filter()->join(', '));
                $isFavorited = in_array($listing->id, $favoriteListingIds ?? [], true);
            @endphp
            <article class="rounded-[22px] border border-slate-200 bg-white overflow-hidden shadow-sm hover:shadow-md transition" data-home-listing-card>
                <div class="relative h-44 sm:h-64 md:h-[290px] bg-slate-100">
                    <a href="{{ route('listings.show', $listing) }}" class="block h-full w-full" aria-label="{{ $listing->title }}">
                        @if($listingImage)
                        @include('listing::partials.responsive-image', [
                            'image' => $listingImage,
                            'alt' => $listing->title,
                            'class' => 'w-full h-full object-cover',
                        ])
                        @else
                        <div class="w-full h-full grid place-items-center text-slate-400">
                            <svg class="w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M4 16l4.5-4.5a2 2 0 012.8 0L16 16m-1.5-1.5l1.8-1.8a2 2 0 012.8 0L21 14m-7-8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        @endif
                    </a>
                    <div class="absolute top-3 left-3 flex items-center gap-2">
                        @if($listing->is_featured)
                        <span class="bg-amber-300 text-amber-950 text-[10px] md:text-xs font-bold px-2 py-1 rounded-full">Featured</span>
                        @endif
                        <span class="bg-sky-500 text-white text-[10px] md:text-xs font-semibold px-2 py-1 rounded-full">Spotlight</span>
                    </div>
                    <div class="absolute top-3 right-3">
                        @auth
                        <form method="POST" action="{{ route('favorites.listings.toggle', $listing) }}">
                            @csrf
                            <button type="submit" class="w-9 h-9 rounded-full grid place-items-center transition {{ $isFavorited ? 'bg-rose-500 text-white' : 'bg-white/90 text-slate-500 hover:text-rose-500' }}">♥</button>
                        </form>
                        @else
                        <a href="{{ route('login') }}" class="w-9 h-9 rounded-full bg-white/90 text-slate-500 hover:text-rose-500 grid place-items-center transition">♡</a>
                        @endauth
                    </div>
                </div>
                <div class="p-3.5 md:p-4">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-[1.7rem] md:text-3xl font-extrabold tracking-tight text-slate-900">{{ $priceLabel }}</p>
                            <h3 class="text-[15px] md:text-xl font-semibold text-slate-800 mt-1 truncate">{{ $listing->title }}</h3>
                        </div>
                        <span class="hidden sm:inline-flex text-xs text-blue-600 bg-blue-50 px-2 py-1 rounded-full font-semibold">12 installments</span>
                    </div>
                    <div class="mt-3 md:mt-5 flex items-center justify-between gap-3 text-xs md:text-sm text-slate-500">
                        <span class="truncate">{{ $locationLabel !== '' ? $locationLabel : 'Location not specified' }}</span>
                        <span class="shrink-0">{{ $listing->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-2 border border-dashed border-slate-300 bg-white rounded-2xl py-20 text-center text-slate-500">
                No listings yet.
            </div>
            @endforelse
        </div>
    </section>

    <section class="rounded-[24px] md:rounded-3xl bg-slate-900 text-white px-5 py-6 md:px-8 md:py-10 md:p-12" data-home-section>
        <div class="grid md:grid-cols-[1fr,auto] gap-6 items-center">
            <div>
                <h2 class="text-[1.45rem] md:text-4xl font-extrabold">{{ __('messages.sell_something') }}</h2>
                <p class="text-slate-300 mt-2 md:mt-3 text-sm md:text-base">Create a free listing in minutes and reach thousands of buyers.</p>
            </div>
            @auth
            <a href="{{ route('panel.listings.create') }}" class="inline-flex items-center justify-center rounded-full bg-rose-500 hover:bg-rose-600 px-6 md:px-8 py-3 font-semibold transition whitespace-nowrap">
                Post listing
            </a>
            @else
            <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full bg-white text-slate-900 hover:bg-slate-100 px-6 md:px-8 py-3 font-semibold transition whitespace-nowrap">
                Start free
            </a>
            @endauth
        </div>
    </section>
</div>
@endif
@if($prepareDemoTurnstileRenderable)
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
@endif
@endsection
