@extends('app::layouts.app')

@section('title', 'İlanlarım')

@section('content')
<div class="max-w-[1320px] mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-[220px,1fr] gap-4">
        @include('panel.partials.sidebar', ['activeMenu' => 'listings'])

        <section class="bg-white border border-slate-200 rounded-xl p-4 sm:p-6">
            <div class="flex flex-col xl:flex-row xl:items-center gap-3 xl:gap-4 mb-5">
                <form method="GET" action="{{ route('panel.listings.index') }}" class="relative flex-1 max-w-xl">
                    <svg class="w-6 h-6 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-4.35-4.35m1.6-5.05a7.25 7.25 0 11-14.5 0 7.25 7.25 0 0114.5 0z"/>
                    </svg>
                    <input type="text" name="search" value="{{ $search }}" placeholder="İlan başlığına göre ara" class="w-full h-14 rounded-2xl border border-slate-300 pl-14 pr-4 text-lg font-semibold text-slate-700 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-rose-200">
                    <input type="hidden" name="status" value="{{ $status }}">
                </form>

                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('panel.listings.index', ['search' => $search, 'status' => 'all']) }}" class="inline-flex items-center h-12 px-6 rounded-full border text-xl font-semibold {{ $status === 'all' ? 'border-rose-500 text-rose-500 bg-rose-50' : 'border-slate-300 text-slate-700 hover:bg-slate-100' }}">
                        Tüm İlanlar ({{ $counts['all'] }})
                    </a>
                    <a href="{{ route('panel.listings.index', ['search' => $search, 'status' => 'sold']) }}" class="inline-flex items-center h-12 px-6 rounded-full border text-xl font-semibold {{ $status === 'sold' ? 'border-rose-500 text-rose-500 bg-rose-50' : 'border-slate-300 text-slate-700 hover:bg-slate-100' }}">
                        Satıldı ({{ $counts['sold'] }})
                    </a>
                    <a href="{{ route('panel.listings.index', ['search' => $search, 'status' => 'expired']) }}" class="inline-flex items-center h-12 px-6 rounded-full border text-xl font-semibold {{ $status === 'expired' ? 'border-rose-500 text-rose-500 bg-rose-50' : 'border-slate-300 text-slate-700 hover:bg-slate-100' }}">
                        Süresi Dolmuş ({{ $counts['expired'] }})
                    </a>
                </div>
            </div>

            <div class="space-y-4">
                @forelse($listings as $listing)
                @php
                    $listingImage = $listing->getFirstMediaUrl('listing-images');
                    $priceLabel = !is_null($listing->price)
                        ? number_format((float) $listing->price, 2, ',', '.').' '.($listing->currency ?? 'TL')
                        : 'Ücretsiz';
                    $statusLabel = match ((string) $listing->status) {
                        'sold' => 'Satıldı',
                        'expired' => 'Süresi Dolmuş',
                        'pending' => 'Onay Bekliyor',
                        default => 'Yayında',
                    };
                    $statusBadgeClass = match ((string) $listing->status) {
                        'sold' => 'bg-emerald-100 text-emerald-700',
                        'expired' => 'bg-rose-100 text-rose-700',
                        'pending' => 'bg-amber-100 text-amber-700',
                        default => 'bg-blue-100 text-blue-700',
                    };
                    $favoriteCount = (int) ($listing->favorited_by_users_count ?? 0);
                    $viewCount = (int) ($listing->view_count ?? 0);
                    $expiresAt = $listing->expires_at?->format('d/m/Y');
                @endphp
                <article class="rounded-2xl border border-slate-300 bg-slate-50 p-4 sm:p-5">
                    <div class="flex flex-col xl:flex-row gap-4 xl:items-stretch">
                        <div class="w-full xl:w-[260px] h-[180px] bg-slate-200 rounded-xl overflow-hidden shrink-0">
                            @if($listingImage)
                            <img src="{{ $listingImage }}" alt="{{ $listing->title }}" class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full grid place-items-center text-slate-400">Görsel yok</div>
                            @endif
                        </div>

                        <div class="flex-1 min-w-0 flex flex-col">
                            <div class="flex flex-wrap items-center gap-3">
                                <p class="text-4xl font-black text-slate-900">{{ $priceLabel }}</p>
                                <span class="inline-flex items-center h-10 px-4 rounded-full text-lg font-bold {{ $statusBadgeClass }}">{{ $statusLabel }}</span>
                            </div>
                            <h2 class="text-2xl font-semibold text-slate-800 mt-3 leading-tight break-words">{{ $listing->title }}</h2>

                            <div class="mt-auto pt-5 flex flex-wrap items-center gap-2">
                                <form method="POST" action="{{ route('panel.listings.destroy', $listing) }}">
                                    @csrf
                                    <button type="submit" class="h-12 px-6 rounded-full border-2 border-rose-500 text-rose-500 text-2xl font-bold hover:bg-rose-50 transition">
                                        İlanı Kaldır
                                    </button>
                                </form>

                                @if((string) $listing->status !== 'sold')
                                <form method="POST" action="{{ route('panel.listings.mark-sold', $listing) }}">
                                    @csrf
                                    <button type="submit" class="h-12 px-6 rounded-full bg-rose-500 text-white text-2xl font-bold hover:bg-rose-600 transition">
                                        Satıldı İşaretle
                                    </button>
                                </form>
                                @endif

                                @if((string) $listing->status === 'expired')
                                <form method="POST" action="{{ route('panel.listings.republish', $listing) }}">
                                    @csrf
                                    <button type="submit" class="h-12 px-6 rounded-full border-2 border-rose-500 text-rose-500 text-2xl font-bold hover:bg-rose-50 transition">
                                        Yeniden Yayınla
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>

                        <div class="xl:w-[260px] flex xl:flex-col items-start xl:items-end justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <div class="h-12 min-w-24 px-4 rounded-2xl bg-slate-200 text-slate-500 text-xl font-bold inline-flex items-center justify-center gap-2">
                                    <span>👁</span>
                                    <span>{{ $viewCount }}</span>
                                </div>
                                <div class="h-12 min-w-24 px-4 rounded-2xl bg-slate-200 text-slate-500 text-xl font-bold inline-flex items-center justify-center gap-2">
                                    <span>♥</span>
                                    <span>{{ $favoriteCount }}</span>
                                </div>
                            </div>

                            <p class="text-lg text-slate-500 text-left xl:text-right">
                                Yayın Tarihi & Bitiş Tarihi:
                                <strong class="text-slate-700">
                                    {{ $listing->created_at?->format('d/m/Y') ?? '-' }} - {{ $expiresAt ?: '-' }}
                                </strong>
                            </p>
                        </div>
                    </div>

                    @if((string) $listing->status === 'expired')
                    <div class="mt-4 rounded-xl bg-sky-100 px-4 py-3 text-base text-slate-700">
                        <strong>Bu ilanın süresi doldu.</strong> Eğer sattıysan, lütfen satıldı olarak işaretle.
                    </div>
                    @endif
                </article>
                @empty
                <div class="rounded-xl border border-dashed border-slate-300 py-16 text-center text-slate-500">
                    Bu filtreye uygun ilan bulunamadı.
                </div>
                @endforelse
            </div>

            @if($listings->hasPages())
            <div class="mt-5">
                {{ $listings->links() }}
            </div>
            @endif
        </section>
    </div>
</div>
@endsection
