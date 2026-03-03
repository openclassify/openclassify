@extends('app::layouts.app')
@section('content')
@php
    $menuCategories = $categories->take(8);
    $heroListing = $featuredListings->first() ?? $recentListings->first();
    $heroImage = $heroListing?->getFirstMediaUrl('listing-images');
    $listingCards = $recentListings->take(6);
    $trendGradients = [
        'from-emerald-500 to-teal-600',
        'from-rose-500 to-pink-600',
        'from-fuchsia-500 to-rose-600',
        'from-sky-500 to-blue-600',
        'from-amber-500 to-orange-600',
        'from-cyan-500 to-indigo-600',
        'from-red-500 to-rose-600',
        'from-violet-500 to-purple-600',
    ];
@endphp

<div class="max-w-[1320px] mx-auto px-4 py-5 md:py-7 space-y-7">
    <section class="bg-white border border-slate-200 rounded-2xl px-2 py-2 overflow-x-auto">
        <div class="flex items-center gap-2 min-w-max">
            <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-full bg-slate-900 text-white text-sm font-semibold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                Tüm Kategoriler
            </a>
            @foreach($menuCategories as $category)
            <a href="{{ route('categories.show', $category) }}" class="px-4 py-2.5 rounded-full text-sm font-medium text-slate-700 hover:bg-slate-100 transition whitespace-nowrap">
                {{ $category->name }}
            </a>
            @endforeach
            <a href="{{ route('listings.index') }}" class="px-4 py-2.5 rounded-full text-sm font-medium text-slate-700 hover:bg-slate-100 transition whitespace-nowrap">
                {{ __('messages.listings') }}
            </a>
        </div>
    </section>

    <section class="relative overflow-hidden rounded-[28px] bg-gradient-to-r from-blue-900 via-blue-700 to-blue-600 text-white shadow-xl">
        <div class="absolute -top-20 -left-24 w-80 h-80 rounded-full bg-blue-400/20 blur-3xl"></div>
        <div class="absolute -bottom-24 right-10 w-80 h-80 rounded-full bg-cyan-300/20 blur-3xl"></div>
        <div class="relative grid lg:grid-cols-[1fr,1.1fr] gap-6 items-center px-8 md:px-12 py-12 md:py-14">
            <div>
                <p class="text-sm uppercase tracking-[0.22em] text-blue-200 font-semibold mb-4">OpenClassify Marketplace</p>
                <h1 class="text-4xl md:text-5xl leading-tight font-extrabold max-w-xl">
                    İlan ücreti ödemeden ürününü hızla sat!
                </h1>
                <p class="mt-4 text-blue-100 text-base md:text-lg max-w-xl">
                    {{ __('messages.hero_subtitle') }}
                </p>
                <div class="mt-8 flex flex-wrap items-center gap-3">
                    <a href="{{ route('listings.index') }}" class="bg-white text-blue-900 px-8 py-3 rounded-full font-semibold hover:bg-blue-50 transition">
                        İncele
                    </a>
                    @auth
                    <a href="{{ route('filament.partner.resources.listings.create', ['tenant' => auth()->id()]) }}" class="border border-blue-200/60 px-8 py-3 rounded-full font-semibold hover:bg-white/10 transition">
                        {{ __('messages.post_listing') }}
                    </a>
                    @else
                    <a href="{{ route('filament.partner.auth.login') }}" class="border border-blue-200/60 px-8 py-3 rounded-full font-semibold hover:bg-white/10 transition">
                        {{ __('messages.post_listing') }}
                    </a>
                    @endauth
                </div>
                <div class="mt-8 flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-white/40"></span>
                    <span class="w-2.5 h-2.5 rounded-full bg-white/40"></span>
                    <span class="w-7 h-2.5 rounded-full bg-white"></span>
                    <span class="w-2.5 h-2.5 rounded-full bg-white/40"></span>
                </div>
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
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-bold text-slate-900">Trend Kategoriler</h2>
            <a href="{{ route('categories.index') }}" class="text-sm font-semibold text-rose-500 hover:text-rose-600 transition">Tümünü Gör</a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-8 gap-3">
            @foreach($menuCategories as $index => $category)
            <a href="{{ route('categories.show', $category) }}" class="group rounded-2xl overflow-hidden bg-white border border-slate-200 hover:shadow-md transition">
                <div class="h-20 bg-gradient-to-r {{ $trendGradients[$index % count($trendGradients)] }} relative">
                    <span class="absolute -bottom-4 right-4 text-3xl drop-shadow">{{ $category->icon ?? '📦' }}</span>
                </div>
                <div class="px-3 py-3">
                    <p class="text-xs font-semibold text-slate-800 leading-tight h-9 overflow-hidden">{{ $category->name }}</p>
                </div>
            </a>
            @endforeach
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
                        <a href="{{ route('filament.partner.auth.login') }}" class="w-9 h-9 rounded-full bg-white/90 text-slate-500 hover:text-rose-500 grid place-items-center transition">♡</a>
                        @endauth
                    </div>
                </div>
                <div class="p-4">
                    <div class="rounded-lg bg-emerald-50 text-emerald-700 text-xs font-semibold px-3 py-1.5 text-center mb-3">
                        Elden al, kartla öde!
                    </div>
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
            <a href="{{ route('filament.partner.resources.listings.create', ['tenant' => auth()->id()]) }}" class="inline-flex items-center justify-center rounded-full bg-rose-500 hover:bg-rose-600 px-8 py-3 font-semibold transition whitespace-nowrap">
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
@endsection
