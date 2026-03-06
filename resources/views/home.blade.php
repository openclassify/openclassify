@extends('app::layouts.app')
@section('content')
@php
    $menuCategories = $categories->take(8);
    $heroListing = $featuredListings->first() ?? $recentListings->first();
    $heroImage = $heroListing?->getFirstMediaUrl('listing-images');
    $listingCards = $recentListings->take(6);
    $homeSlides = collect($generalSettings['home_slides'] ?? [])
        ->filter(fn ($slide): bool => is_array($slide))
        ->map(function (array $slide): array {
            $badge = trim((string) ($slide['badge'] ?? ''));
            $title = trim((string) ($slide['title'] ?? ''));
            $subtitle = trim((string) ($slide['subtitle'] ?? ''));
            $primaryButtonText = trim((string) ($slide['primary_button_text'] ?? ''));
            $secondaryButtonText = trim((string) ($slide['secondary_button_text'] ?? ''));

            return [
                'badge' => $badge !== '' ? $badge : 'OpenClassify Marketplace',
                'title' => $title !== '' ? $title : 'İlan ücreti ödemeden ürününü hızla sat!',
                'subtitle' => $subtitle !== '' ? $subtitle : 'Buy and sell everything in your area',
                'primary_button_text' => $primaryButtonText !== '' ? $primaryButtonText : 'İncele',
                'secondary_button_text' => $secondaryButtonText !== '' ? $secondaryButtonText : 'Post Listing',
            ];
        })
        ->values();

    if ($homeSlides->isEmpty()) {
        $homeSlides = collect([
            [
                'badge' => 'OpenClassify Marketplace',
                'title' => 'İlan ücreti ödemeden ürününü hızla sat!',
                'subtitle' => 'Buy and sell everything in your area',
                'primary_button_text' => 'İncele',
                'secondary_button_text' => 'Post Listing',
            ],
        ]);
    }

    $trendSkins = [
        ['gradient' => 'from-emerald-800 via-emerald-700 to-emerald-600', 'glow' => 'bg-emerald-200/45'],
        ['gradient' => 'from-rose-700 via-rose-600 to-pink-500', 'glow' => 'bg-rose-200/40'],
        ['gradient' => 'from-rose-700 via-pink-600 to-fuchsia-500', 'glow' => 'bg-pink-200/40'],
        ['gradient' => 'from-rose-700 via-rose-600 to-orange-500', 'glow' => 'bg-orange-200/40'],
        ['gradient' => 'from-rose-700 via-pink-600 to-red-500', 'glow' => 'bg-rose-200/40'],
        ['gradient' => 'from-fuchsia-700 via-pink-600 to-rose-500', 'glow' => 'bg-fuchsia-200/40'],
        ['gradient' => 'from-rose-700 via-rose-600 to-pink-500', 'glow' => 'bg-rose-200/40'],
        ['gradient' => 'from-red-700 via-rose-600 to-pink-500', 'glow' => 'bg-red-200/40'],
    ];
    $trendIcons = [
        'gift',
        'computer',
        'bike',
        'sparkles',
        'coffee',
        'laptop',
        'fitness',
        'game',
    ];
@endphp

<div class="max-w-[1320px] mx-auto px-4 py-5 md:py-7 space-y-7">
    <section class="relative overflow-hidden rounded-[28px] bg-gradient-to-r from-blue-900 via-blue-700 to-blue-600 text-white shadow-xl">
        <div class="absolute -top-20 -left-24 w-80 h-80 rounded-full bg-blue-400/20 blur-3xl"></div>
        <div class="absolute -bottom-24 right-10 w-80 h-80 rounded-full bg-cyan-300/20 blur-3xl"></div>
        <div class="relative grid lg:grid-cols-[1fr,1.1fr] gap-6 items-center px-8 md:px-12 py-12 md:py-14">
            <div data-home-slider>
                <div class="relative min-h-[250px]">
                    @foreach($homeSlides as $index => $slide)
                    <div
                        data-home-slide
                        @class(['transition-opacity duration-300', 'hidden' => $index !== 0])
                        aria-hidden="{{ $index === 0 ? 'false' : 'true' }}"
                    >
                        <p class="text-sm uppercase tracking-[0.22em] text-blue-200 font-semibold mb-4">{{ $slide['badge'] }}</p>
                        <h1 class="text-4xl md:text-5xl leading-tight font-extrabold max-w-xl">{{ $slide['title'] }}</h1>
                        <p class="mt-4 text-blue-100 text-base md:text-lg max-w-xl">{{ $slide['subtitle'] }}</p>
                        <div class="mt-8 flex flex-wrap items-center gap-3">
                            <a href="{{ route('listings.index') }}" class="bg-white text-blue-900 px-8 py-3 rounded-full font-semibold hover:bg-blue-50 transition">
                                {{ $slide['primary_button_text'] }}
                            </a>
                            @auth
                            <a href="{{ route('panel.listings.create') }}" class="border border-blue-200/60 px-8 py-3 rounded-full font-semibold hover:bg-white/10 transition">
                                {{ $slide['secondary_button_text'] }}
                            </a>
                            @else
                            <a href="{{ route('login') }}" class="border border-blue-200/60 px-8 py-3 rounded-full font-semibold hover:bg-white/10 transition">
                                {{ $slide['secondary_button_text'] }}
                            </a>
                            @endauth
                        </div>
                    </div>
                    @endforeach
                </div>

                @if($homeSlides->count() > 1)
                <div class="mt-8 flex items-center gap-2">
                    <button
                        type="button"
                        data-home-slide-prev
                        class="w-8 h-8 rounded-full border border-white/45 text-white grid place-items-center hover:bg-white/15 transition"
                        aria-label="Önceki slide"
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
                        class="w-8 h-8 rounded-full border border-white/45 text-white grid place-items-center hover:bg-white/15 transition"
                        aria-label="Sonraki slide"
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
            <div class="relative h-[310px] md:h-[360px]">
                <div class="absolute left-6 md:left-10 bottom-0 w-32 md:w-40 h-[250px] md:h-[300px] bg-slate-950 rounded-[32px] shadow-2xl p-2 rotate-[-8deg]">
                    <div class="w-full h-full rounded-[24px] bg-white overflow-hidden">
                        <div class="px-3 py-2 border-b border-slate-100">
                            <p class="text-rose-500 text-sm font-bold">OpenClassify</p>
                            <p class="text-[10px] text-slate-400 mt-1">Ürün, kategori, satıcı ara</p>
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
                <div class="absolute right-0 bottom-0 w-[78%] h-[88%] rounded-[28px] bg-gradient-to-br from-white/20 to-blue-500/40 border border-white/20 shadow-2xl flex items-end justify-center p-4">
                    @if($heroImage)
                    <img src="{{ $heroImage }}" alt="{{ $heroListing?->title }}" class="w-full h-full object-cover rounded-2xl">
                    @else
                    <div class="w-full h-full rounded-2xl bg-white/90 text-slate-800 flex flex-col justify-center items-center gap-3">
                        <span class="text-6xl">🚗</span>
                        <p class="text-sm font-semibold px-4 text-center">Görsel eklendiğinde burada öne çıkan ilan yer alacak.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-3xl font-extrabold tracking-tight text-slate-900">Trend Kategoriler</h2>
            <a href="{{ route('categories.index') }}" class="hidden sm:inline-flex text-sm font-semibold text-rose-500 hover:text-rose-600 transition">
                Tümünü Gör
            </a>
        </div>
        <div class="relative">
            <button
                type="button"
                data-trend-prev
                class="hidden lg:inline-flex absolute left-0 top-1/2 -translate-x-1/2 -translate-y-1/2 z-10 w-11 h-11 rounded-full border border-slate-300 bg-white text-slate-700 items-center justify-center shadow-sm hover:bg-slate-50 transition"
                aria-label="Önceki trend kategori"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 18-6-6 6-6"/>
                </svg>
            </button>
            <div data-trend-track class="flex items-stretch gap-2 overflow-x-auto pb-2 pr-1 scroll-smooth snap-x snap-mandatory [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
            @foreach($menuCategories as $index => $category)
            @php
                $trendSkin = $trendSkins[$index % count($trendSkins)];
                $trendIcon = $trendIcons[$index % count($trendIcons)];
            @endphp
            <a href="{{ route('listings.index', ['category' => $category->id]) }}" class="group shrink-0 w-[170px] rounded-xl overflow-hidden border border-slate-300/80 bg-white hover:shadow-md transition snap-start">
                <div class="h-[68px] bg-gradient-to-r {{ $trendSkin['gradient'] }} relative overflow-hidden">
                    <span class="absolute -left-5 top-2 w-20 h-20 rounded-full {{ $trendSkin['glow'] }} blur-2xl"></span>
                    <span class="absolute left-5 bottom-2 h-2.5 w-24 rounded-full bg-black/20"></span>
                    <span class="absolute right-3 bottom-2 w-11 h-11 rounded-lg border border-white/35 bg-white/10 backdrop-blur-sm text-white grid place-items-center shadow-sm">
                        @switch($trendIcon)
                            @case('gift')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20 12v8a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-8m16 0H4m16 0V8a1 1 0 0 0-1-1h-3.5M4 12V8a1 1 0 0 1 1-1h3.5m0 0a2 2 0 1 1 0-4c2.5 0 3.5 4 3.5 4m-3.5 0h7m0 0a2 2 0 1 0 0-4c-2.5 0-3.5 4-3.5 4"/>
                                </svg>
                                @break
                            @case('computer')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5Zm4 16h10m-8 0 1.5-3m4 3L13 18"/>
                                </svg>
                                @break
                            @case('bike')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5.5 17.5A3.5 3.5 0 1 0 5.5 10a3.5 3.5 0 0 0 0 7.5Zm13 0A3.5 3.5 0 1 0 18.5 10a3.5 3.5 0 0 0 0 7.5ZM8.5 14l3-5h3l2 5m-5-5L9 6h3"/>
                                </svg>
                                @break
                            @case('sparkles')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m9 5 1.4 2.6L13 9l-2.6 1.4L9 13l-1.4-2.6L5 9l2.6-1.4L9 5Zm8 4 1 1.9L20 12l-2 1.1-1 1.9-1-1.9-2-1.1 2-1.1L17 9ZM7 16l1.5 2.8L11.5 20 8.5 21.2 7 24l-1.5-2.8L2.5 20l3-1.2L7 16Z"/>
                                </svg>
                                @break
                            @case('coffee')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 8v7a3 3 0 0 0 3 3h4a3 3 0 0 0 3-3V8H7Zm10 2h1a2 2 0 1 1 0 4h-1M8 4v2m4-2v2m4-2v2M6 21h12"/>
                                </svg>
                                @break
                            @case('laptop')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8H4V6Zm-1 10h18l-1.2 3H4.2L3 16Z"/>
                                </svg>
                                @break
                            @case('fitness')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 10h2v4H3v-4Zm16 0h2v4h-2v-4ZM7 8h2v8H7V8Zm8 0h2v8h-2V8Zm-4 2h2v4h-2v-4Z"/>
                                </svg>
                                @break
                            @default
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 6h3a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-3m-6 0H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h3m3 4h.01m-1 8h2a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2Z"/>
                                </svg>
                        @endswitch
                    </span>
                </div>
                <div class="px-3 py-2.5">
                    <p class="text-[12px] sm:text-[13px] font-semibold text-slate-900 leading-tight truncate">{{ $category->name }}</p>
                </div>
            </a>
            @endforeach
            </div>
            <button
                type="button"
                data-trend-next
                class="hidden lg:inline-flex absolute right-0 top-1/2 translate-x-1/2 -translate-y-1/2 z-10 w-11 h-11 rounded-full border border-slate-300 bg-white text-slate-700 items-center justify-center shadow-sm hover:bg-slate-50 transition"
                aria-label="Sonraki trend kategori"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 18 6-6-6-6"/>
                </svg>
            </button>
        </div>
    </section>

    <section>
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-bold text-slate-900">Popüler İkinci El İlanlar</h2>
            <div class="hidden sm:flex items-center gap-2 text-sm text-slate-500">
                <span class="w-8 h-8 rounded-full border border-slate-300 grid place-items-center">‹</span>
                <span class="w-8 h-8 rounded-full border border-slate-300 grid place-items-center">›</span>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            @forelse($listingCards as $listing)
            @php
                $listingImage = $listing->getFirstMediaUrl('listing-images');
                $priceLabel = $listing->price ? number_format((float) $listing->price, 0).' '.$listing->currency : __('messages.free');
                $locationLabel = trim(collect([$listing->city, $listing->country])->filter()->join(', '));
                $isFavorited = in_array($listing->id, $favoriteListingIds ?? [], true);
            @endphp
            <article class="rounded-2xl border border-slate-200 bg-white overflow-hidden shadow-sm hover:shadow-md transition">
                <div class="relative h-64 md:h-[290px] bg-slate-100">
                    @if($listingImage)
                    <img src="{{ $listingImage }}" alt="{{ $listing->title }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full grid place-items-center text-slate-400">
                        <svg class="w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M4 16l4.5-4.5a2 2 0 012.8 0L16 16m-1.5-1.5l1.8-1.8a2 2 0 012.8 0L21 14m-7-8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    @endif
                    <div class="absolute top-3 left-3 flex items-center gap-2">
                        @if($listing->is_featured)
                        <span class="bg-amber-300 text-amber-950 text-xs font-bold px-2.5 py-1 rounded-full">Öne Çıkan</span>
                        @endif
                        <span class="bg-sky-500 text-white text-xs font-semibold px-2.5 py-1 rounded-full">Büyük İlan</span>
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
                <div class="p-4">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-3xl font-extrabold tracking-tight text-slate-900">{{ $priceLabel }}</p>
                            <h3 class="text-xl font-semibold text-slate-800 mt-1 truncate">{{ $listing->title }}</h3>
                        </div>
                        <span class="text-xs text-blue-600 bg-blue-50 px-2 py-1 rounded-full font-semibold">12 taksit</span>
                    </div>
                    <div class="mt-5 flex items-center justify-between text-sm text-slate-500">
                        <span class="truncate">{{ $locationLabel !== '' ? $locationLabel : 'Konum belirtilmedi' }}</span>
                        <span>{{ $listing->created_at->diffForHumans() }}</span>
                    </div>
                    <a href="{{ route('listings.show', $listing) }}" class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-blue-700 hover:text-blue-900 transition">
                        İlan detayını aç
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </article>
            @empty
            <div class="col-span-2 border border-dashed border-slate-300 bg-white rounded-2xl py-20 text-center text-slate-500">
                Henüz ilan bulunmuyor.
            </div>
            @endforelse
        </div>
    </section>

    <section class="rounded-3xl bg-slate-900 text-white px-8 py-10 md:p-12">
        <div class="grid md:grid-cols-[1fr,auto] gap-6 items-center">
            <div>
                <h2 class="text-3xl md:text-4xl font-extrabold">{{ __('messages.sell_something') }}</h2>
                <p class="text-slate-300 mt-3">Dakikalar içinde ücretsiz ilan oluştur, binlerce alıcıya ulaş.</p>
            </div>
            @auth
            <a href="{{ route('panel.listings.create') }}" class="inline-flex items-center justify-center rounded-full bg-rose-500 hover:bg-rose-600 px-8 py-3 font-semibold transition whitespace-nowrap">
                Hemen İlan Ver
            </a>
            @else
            <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full bg-white text-slate-900 hover:bg-slate-100 px-8 py-3 font-semibold transition whitespace-nowrap">
                Ücretsiz Başla
            </a>
            @endauth
        </div>
    </section>
</div>
<script>
    (() => {
        const setupTrendCategories = () => {
            const track = document.querySelector('[data-trend-track]');
            const previousButton = document.querySelector('[data-trend-prev]');
            const nextButton = document.querySelector('[data-trend-next]');

            if (!track || !previousButton || !nextButton) {
                return;
            }

            const scrollAmount = () => Math.max(240, Math.floor(track.clientWidth * 0.7));

            previousButton.addEventListener('click', () => {
                track.scrollBy({ left: -scrollAmount(), behavior: 'smooth' });
            });

            nextButton.addEventListener('click', () => {
                track.scrollBy({ left: scrollAmount(), behavior: 'smooth' });
            });
        };

        const setupHomeSlider = () => {
            const slider = document.querySelector('[data-home-slider]');

            if (!slider) {
                return;
            }

            const slides = Array.from(slider.querySelectorAll('[data-home-slide]'));
            const dots = Array.from(slider.querySelectorAll('[data-home-slide-dot]'));
            const previousButton = slider.querySelector('[data-home-slide-prev]');
            const nextButton = slider.querySelector('[data-home-slide-next]');

            if (slides.length <= 1) {
                return;
            }

            let activeIndex = 0;
            let intervalId = null;

            const activateSlide = (index) => {
                activeIndex = (index + slides.length) % slides.length;

                slides.forEach((slide, slideIndex) => {
                    const isActive = slideIndex === activeIndex;

                    slide.classList.toggle('hidden', !isActive);
                    slide.setAttribute('aria-hidden', isActive ? 'false' : 'true');
                });

                dots.forEach((dot, dotIndex) => {
                    const isActive = dotIndex === activeIndex;

                    dot.classList.toggle('w-7', isActive);
                    dot.classList.toggle('bg-white', isActive);
                    dot.classList.toggle('w-2.5', !isActive);
                    dot.classList.toggle('bg-white/40', !isActive);
                });
            };

            const stopAutoPlay = () => {
                if (intervalId !== null) {
                    window.clearInterval(intervalId);
                    intervalId = null;
                }
            };

            const startAutoPlay = () => {
                stopAutoPlay();
                intervalId = window.setInterval(() => activateSlide(activeIndex + 1), 6000);
            };

            previousButton?.addEventListener('click', () => {
                activateSlide(activeIndex - 1);
                startAutoPlay();
            });

            nextButton?.addEventListener('click', () => {
                activateSlide(activeIndex + 1);
                startAutoPlay();
            });

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    activateSlide(index);
                    startAutoPlay();
                });
            });

            slider.addEventListener('mouseenter', stopAutoPlay);
            slider.addEventListener('mouseleave', startAutoPlay);
            slider.addEventListener('focusin', stopAutoPlay);
            slider.addEventListener('focusout', startAutoPlay);

            activateSlide(0);
            startAutoPlay();
        };

        setupHomeSlider();
        setupTrendCategories();
    })();
</script>
@endsection
