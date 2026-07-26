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
    $homeSlide = collect($generalSettings['home_slides'] ?? [])
        ->first(fn ($slide): bool => is_array($slide));

    $heroBadge = trim((string) ($homeSlide['badge'] ?? '')) ?: 'OpenClassify Marketplace';
    $heroTitle = trim((string) ($homeSlide['title'] ?? '')) ?: 'A cleaner local marketplace.';
    $heroSubtitle = trim((string) ($homeSlide['subtitle'] ?? '')) ?: 'Buy and sell everything in your area.';
    $heroPrimaryLabel = trim((string) ($homeSlide['primary_button_text'] ?? '')) ?: 'Browse Listings';
    $heroSecondaryLabel = trim((string) ($homeSlide['secondary_button_text'] ?? '')) ?: 'Post Listing';
@endphp

@if($demoLandingMode && $prepareDemoRoute)
<div class="min-h-screen flex items-center justify-center px-5 py-10">
    <form method="POST" action="{{ $prepareDemoRoute }}" data-demo-prepare-form data-turnstile-required="{{ $prepareDemoTurnstileRequired ? '1' : '0' }}" class="w-full max-w-xl rounded-[32px] border border-slate-200 bg-white p-8 md:p-10">
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
        <button type="submit" data-demo-prepare-button @if($prepareDemoTurnstileRequired) disabled @endif class="mt-8 inline-flex min-h-16 w-full items-center justify-center rounded-full bg-blue-600 px-8 py-4 text-lg font-semibold text-white hover:bg-blue-700 disabled:cursor-not-allowed disabled:bg-blue-500">
            <span data-demo-prepare-idle>Prepare Demo</span>
            <span data-demo-prepare-loading class="hidden items-center gap-2">
                Preparing Demo...
            </span>
        </button>
    </form>
</div>
@else
<div class="max-w-[1120px] mx-auto px-4 py-8 md:py-14 space-y-10 md:space-y-16">
    <section class="grid lg:grid-cols-[1.1fr,0.9fr] gap-8 lg:gap-12 items-center">
        <div>
            <p class="text-xs uppercase tracking-[0.22em] text-[var(--oc-muted)] font-semibold mb-3">{{ $heroBadge }}</p>
            <h1 class="text-3xl md:text-5xl leading-[1.1] font-semibold text-[var(--oc-text)] max-w-xl">{{ $heroTitle }}</h1>
            <p class="mt-4 text-[var(--oc-muted)] text-base md:text-lg max-w-xl leading-7">{{ $heroSubtitle }}</p>
            <div class="mt-8 flex flex-wrap items-center gap-3">
                <a href="{{ route('listings.index') }}" class="btn-primary px-6 py-3 text-sm font-semibold">
                    {{ $heroPrimaryLabel }}
                </a>
                @auth
                <a href="{{ route('panel.listings.create') }}" class="oc-text-link px-2 py-3 text-sm font-semibold">
                    {{ $heroSecondaryLabel }}
                </a>
                @else
                <a href="{{ route('login') }}" class="oc-text-link px-2 py-3 text-sm font-semibold">
                    {{ $heroSecondaryLabel }}
                </a>
                @endauth
            </div>
        </div>
        <div class="hidden lg:block rounded-[28px] overflow-hidden border border-[var(--oc-border)] bg-[var(--oc-surface)] aspect-[4/3]">
            @if($heroImage)
            @include('listing::partials.responsive-image', [
                'image' => $heroImage,
                'alt' => $heroListing?->title,
                'class' => 'w-full h-full object-cover',
                'loading' => 'eager',
                'fetchpriority' => 'high',
            ])
            @else
            <div class="w-full h-full grid place-items-center text-[var(--oc-muted)] text-sm font-medium px-6 text-center">
                Featured listings will appear here.
            </div>
            @endif
        </div>
    </section>

    <section>
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl md:text-2xl font-semibold text-[var(--oc-text)]">Browse Categories</h2>
            <a href="{{ route('categories.index') }}" class="oc-text-link text-sm font-semibold">
                View all
            </a>
        </div>
        <div class="flex flex-wrap gap-2">
            @foreach($menuCategories as $category)
            @php
                $categoryIconUrl = $category->iconUrl();
                $fallbackLabel = strtoupper(\Illuminate\Support\Str::substr($category->name, 0, 1));
            @endphp
            <a href="{{ route('listings.index', ['category' => $category->id]) }}" class="oc-pill">
                @if($categoryIconUrl)
                    <img src="{{ $categoryIconUrl }}" alt="" class="h-4 w-4 object-contain">
                @else
                    <span class="text-xs font-semibold">{{ $fallbackLabel }}</span>
                @endif
                <span>{{ $category->name }}</span>
            </a>
            @endforeach
        </div>
    </section>

    <section>
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl md:text-2xl font-semibold text-[var(--oc-text)]">Recent Listings</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @forelse($listingCards as $listing)
            @php
                $listingImage = $listing->primaryImageData('card');
                $priceLabel = $listing->price ? number_format((float) $listing->price, 0).' '.$listing->currency : __('messages.free');
                $locationLabel = trim(collect([$listing->city, $listing->country])->filter()->join(', '));
                $isFavorited = in_array($listing->id, $favoriteListingIds ?? [], true);
            @endphp
            <article class="rounded-2xl border border-[var(--oc-border)] bg-[var(--oc-surface)] overflow-hidden">
                <div class="relative h-56 md:h-64 bg-[var(--oc-bg)]">
                    <a href="{{ route('listings.show', $listing) }}" class="block h-full w-full" aria-label="{{ $listing->title }}">
                        @if($listingImage)
                        @include('listing::partials.responsive-image', [
                            'image' => $listingImage,
                            'alt' => $listing->title,
                            'class' => 'w-full h-full object-cover',
                        ])
                        @else
                        <div class="w-full h-full grid place-items-center text-[var(--oc-muted)] text-sm">
                            No image
                        </div>
                        @endif
                    </a>
                    @if($listing->is_featured)
                    <span class="absolute top-3 left-3 bg-[var(--oc-surface)] border border-[var(--oc-border)] text-[var(--oc-text)] text-xs font-semibold px-2 py-1 rounded-full">Featured</span>
                    @endif
                    <div class="absolute top-3 right-3">
                        @auth
                        <form method="POST" action="{{ route('favorites.listings.toggle', $listing) }}">
                            @csrf
                            <button type="submit" class="w-9 h-9 rounded-full grid place-items-center border border-[var(--oc-border)] {{ $isFavorited ? 'bg-[var(--oc-text)] text-white' : 'bg-[var(--oc-surface)] text-[var(--oc-muted)]' }}">♥</button>
                        </form>
                        @else
                        <a href="{{ route('login') }}" class="w-9 h-9 rounded-full bg-[var(--oc-surface)] border border-[var(--oc-border)] text-[var(--oc-muted)] grid place-items-center">♡</a>
                        @endauth
                    </div>
                </div>
                <div class="p-4">
                    <p class="text-xl font-semibold tracking-tight text-[var(--oc-text)]">{{ $priceLabel }}</p>
                    <h3 class="text-sm font-medium text-[var(--oc-text)] mt-1 truncate">{{ $listing->title }}</h3>
                    <div class="mt-3 flex items-center justify-between gap-3 text-xs text-[var(--oc-muted)]">
                        <span class="truncate">{{ $locationLabel !== '' ? $locationLabel : 'Location not specified' }}</span>
                        <span class="shrink-0">{{ $listing->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-2 border border-dashed border-[var(--oc-border)] rounded-2xl py-20 text-center text-[var(--oc-muted)]">
                No listings yet.
            </div>
            @endforelse
        </div>
    </section>

    <section class="rounded-2xl border border-[var(--oc-border)] px-6 py-8 md:px-10 md:py-12">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-xl md:text-2xl font-semibold text-[var(--oc-text)]">{{ __('messages.sell_something') }}</h2>
                <p class="text-[var(--oc-muted)] mt-2 text-sm md:text-base">Create a free listing in minutes and reach buyers in your area.</p>
            </div>
            @auth
            <a href="{{ route('panel.listings.create') }}" class="btn-primary px-6 py-3 font-semibold whitespace-nowrap">
                Post listing
            </a>
            @else
            <a href="{{ route('register') }}" class="btn-primary px-6 py-3 font-semibold whitespace-nowrap">
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
