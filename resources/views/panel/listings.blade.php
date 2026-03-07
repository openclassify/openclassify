@extends('app::layouts.app')

@section('title', 'İlanlarım')

@section('content')
@php
    $statusTabs = [
        [
            'key' => 'all',
            'label' => 'Tüm İlanlar',
            'count' => (int) ($counts['all'] ?? 0),
            'description' => 'Hesabındaki tüm ilanlar',
        ],
        [
            'key' => 'sold',
            'label' => 'Satıldı',
            'count' => (int) ($counts['sold'] ?? 0),
            'description' => 'Kapanan satışlar',
        ],
        [
            'key' => 'expired',
            'label' => 'Süresi Doldu',
            'count' => (int) ($counts['expired'] ?? 0),
            'description' => 'Yeniden yayın bekleyenler',
        ],
    ];
    $overviewCards = [
        [
            'label' => 'Toplam İlan',
            'value' => (int) ($counts['all'] ?? 0),
            'hint' => 'Panelindeki tüm kayıtlar',
        ],
        [
            'label' => 'Yayında',
            'value' => (int) ($counts['active'] ?? 0),
            'hint' => 'Şu anda ziyaretçilere açık',
        ],
        [
            'label' => 'Satıldı',
            'value' => (int) ($counts['sold'] ?? 0),
            'hint' => 'Satışla kapanan ilanlar',
        ],
        [
            'label' => 'Süresi Doldu',
            'value' => (int) ($counts['expired'] ?? 0),
            'hint' => 'Yeniden yayın bekleyen ilanlar',
        ],
    ];
    $hasFilters = $search !== '' || $status !== 'all';
    $pendingCount = (int) ($counts['pending'] ?? 0);
@endphp

<div class="listings-dashboard-page mx-auto max-w-[1320px] px-4 py-6 md:py-8">
    <div class="grid gap-6 xl:grid-cols-[300px,minmax(0,1fr)]">
        <aside class="listings-dashboard-sidebar space-y-6">
            @include('panel.partials.sidebar', ['activeMenu' => 'listings'])

            <div class="overflow-hidden rounded-[30px] border border-slate-200/80 bg-white/90 p-6 shadow-[0_20px_55px_rgba(15,23,42,0.08)] backdrop-blur">
                <p class="account-section-kicker">Kontrol Merkezi</p>
                <h2 class="mt-2 text-2xl font-semibold tracking-[-0.03em] text-slate-950">İlanlarını tek bakışta yönet</h2>
                <p class="mt-3 text-sm leading-6 text-slate-500">
                    Yayındaki, satılan ve süresi dolan ilanlarını daha hızlı filtrele. Arama alanı sadece gerekli yerde, aksiyonlar ise her kartta doğrudan görünür.
                </p>

                <div class="mt-5 rounded-[24px] bg-slate-950 px-5 py-4 text-white shadow-[0_18px_38px_rgba(15,23,42,0.18)]">
                    <p class="text-[0.68rem] font-semibold uppercase tracking-[0.26em] text-slate-300">Bugün</p>
                    <p class="mt-2 text-sm leading-6 text-slate-200">
                        @if ($pendingCount > 0)
                            {{ $pendingCount }} ilan moderasyon incelemesinde. Onaylanınca burada yayında olarak görünecek.
                        @else
                            Bu ekranda ilanlarının durumu, etkileşimi ve yayın süresi birlikte özetlenir.
                        @endif
                    </p>
                </div>
            </div>
        </aside>

        <section class="space-y-6">
            <div class="listings-dashboard-hero">
                <div class="min-w-0">
                    <p class="account-section-kicker">Panel</p>
                    <h1 class="mt-2 text-[2.3rem] font-semibold leading-tight tracking-[-0.04em] text-slate-950">İlanlarım</h1>
                    <p class="mt-3 max-w-3xl text-sm leading-6 text-slate-500">
                        Tüm ilanlarını tek ekranda takip et. Tarih, durum ve etkileşim bilgileri artık daha net; arama ve filtre alanı ise daha kompakt.
                    </p>
                </div>

                <div class="flex shrink-0 flex-col gap-3 sm:flex-row sm:items-center">
                    @if ($hasFilters)
                        <a href="{{ route('panel.listings.index') }}" class="account-secondary-button">Filtreleri Temizle</a>
                    @endif

                    <a href="{{ route('panel.listings.create') }}" class="account-primary-button">Yeni İlan Ver</a>
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 2xl:grid-cols-4">
                @foreach ($overviewCards as $card)
                    <div class="listings-dashboard-stat">
                        <p class="text-sm font-semibold text-slate-500">{{ $card['label'] }}</p>
                        <p class="mt-3 text-4xl font-semibold tracking-[-0.04em] text-slate-950">{{ number_format($card['value']) }}</p>
                        <p class="mt-2 text-sm leading-6 text-slate-500">{{ $card['hint'] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="listings-dashboard-filter-shell">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                    <div>
                        <p class="account-section-kicker">Filtrele</p>
                        <h2 class="mt-2 text-2xl font-semibold tracking-[-0.03em] text-slate-950">Arama ve durum</h2>
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            {{ number_format($listings->total()) }} sonuç içinde başlığa göre ara veya görünümü hızlıca daralt.
                        </p>
                    </div>

                    <form method="GET" action="{{ route('panel.listings.index') }}" class="listings-dashboard-search">
                        <svg class="listings-dashboard-search-icon h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-4.35-4.35m1.6-5.05a7.25 7.25 0 11-14.5 0 7.25 7.25 0 0114.5 0z"/>
                        </svg>
                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            placeholder="İlan başlığına göre ara"
                            class="listings-dashboard-search-input"
                        >
                        <input type="hidden" name="status" value="{{ $status }}">
                        <button type="submit" class="listings-dashboard-search-button">Ara</button>
                    </form>
                </div>

                <div class="mt-5 flex flex-wrap gap-3">
                    @foreach ($statusTabs as $tab)
                        <a
                            href="{{ route('panel.listings.index', ['search' => $search, 'status' => $tab['key']]) }}"
                            @class([
                                'listings-dashboard-tab',
                                'is-active' => $status === $tab['key'],
                            ])
                        >
                            <span class="listings-dashboard-tab-label">{{ $tab['label'] }}</span>
                            <span class="listings-dashboard-tab-count">{{ number_format($tab['count']) }}</span>
                            <span class="listings-dashboard-tab-description">{{ $tab['description'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="space-y-4">
                @forelse ($listings as $listing)
                    @php
                        $statusMeta = $listing->panelStatusMeta();
                        $listingImage = $listing->panelPrimaryImageUrl();
                        $priceLabel = $listing->panelPriceLabel();
                        $favoriteCount = (int) ($listing->favorited_by_users_count ?? 0);
                        $viewCount = (int) ($listing->view_count ?? 0);
                        $publishedAt = $listing->panelPublishedAt();
                        $publishedLabel = $publishedAt?->format('d.m.Y') ?? '-';
                        $expiresLabel = $listing->expires_at?->format('d.m.Y') ?? 'Süresiz';
                        $videoCount = (int) ($listing->videos_count ?? 0);
                        $readyVideoCount = (int) ($listing->ready_videos_count ?? 0);
                        $pendingVideoCount = (int) ($listing->pending_videos_count ?? 0);
                        $videoSummary = $listing->panelVideoSummary($videoCount, $readyVideoCount, $pendingVideoCount);
                    @endphp

                    <article class="listings-dashboard-card">
                        <a href="{{ route('listings.show', $listing) }}" class="listings-dashboard-media" aria-label="{{ $listing->title }}">
                            @if ($listingImage)
                                <img src="{{ $listingImage }}" alt="{{ $listing->title }}" class="h-full w-full object-cover">
                            @else
                                <div class="listings-dashboard-placeholder">
                                    <span>Görsel Yok</span>
                                </div>
                            @endif
                        </a>

                        <div class="min-w-0 space-y-5">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="listings-dashboard-status {{ $statusMeta['badge_class'] }}">{{ $statusMeta['label'] }}</span>

                                @if ($listing->category)
                                    <span class="listings-dashboard-meta-chip">{{ $listing->category->name }}</span>
                                @endif

                                <span class="listings-dashboard-meta-chip">{{ $listing->panelLocationLabel() }}</span>
                            </div>

                            <div class="space-y-3">
                                <div class="flex flex-col gap-3 lg:flex-row lg:items-start lg:justify-between">
                                    <div class="min-w-0">
                                        <h3 class="listings-dashboard-card-title">{{ $listing->title }}</h3>
                                        <p class="mt-2 text-sm leading-6 text-slate-500">{{ $statusMeta['hint'] }}</p>
                                    </div>

                                    <p class="listings-dashboard-price-mobile">{{ $priceLabel }}</p>
                                </div>

                                <div class="grid gap-3 md:grid-cols-3">
                                    <div class="listings-dashboard-info-card">
                                        <span class="listings-dashboard-info-label">Yayına alındı</span>
                                        <strong>{{ $publishedLabel }}</strong>
                                        <span>İlk görünür olduğu kayıt tarihi</span>
                                    </div>

                                    <div class="listings-dashboard-info-card">
                                        <span class="listings-dashboard-info-label">{{ $listing->expires_at ? 'Bitiş tarihi' : 'Yayın süresi' }}</span>
                                        <strong>{{ $expiresLabel }}</strong>
                                        <span>{{ $listing->panelExpirySummary() }}</span>
                                    </div>

                                    <div class="listings-dashboard-info-card">
                                        <span class="listings-dashboard-info-label">Etkileşim</span>
                                        <strong>{{ number_format($viewCount) }} görüntülenme</strong>
                                        <span>{{ number_format($favoriteCount) }} favori</span>
                                    </div>
                                </div>
                            </div>

                            @if ($videoSummary)
                                <div class="flex flex-wrap gap-2">
                                    <span class="listings-dashboard-soft-chip">{{ $videoSummary['label'] }}</span>
                                    <span class="listings-dashboard-soft-chip is-muted">{{ $videoSummary['detail'] }}</span>
                                </div>
                            @endif

                            @if ($listing->statusValue() === 'expired')
                                <div class="listings-dashboard-alert is-danger">
                                    Bu ilanın süresi doldu. Satıldıysa kapatabilir, devam edecekse yeniden yayına alabilirsin.
                                </div>
                            @elseif ($listing->statusValue() === 'pending')
                                <div class="listings-dashboard-alert is-warning">
                                    İlan şu anda moderasyon kontrolünde. Onaylandığında otomatik olarak yayında görünür.
                                </div>
                            @endif

                            <div class="flex flex-col gap-4 border-t border-slate-200/80 pt-5 xl:flex-row xl:items-center xl:justify-between">
                                <div class="flex flex-wrap gap-3">
                                    <a href="{{ route('listings.show', $listing) }}" class="account-secondary-button">İlanı Gör</a>
                                    <a href="{{ route('panel.listings.edit', $listing) }}" class="account-primary-button">Düzenle</a>
                                </div>

                                <div class="flex flex-wrap gap-3">
                                    @if ($listing->statusValue() === 'expired')
                                        <form method="POST" action="{{ route('panel.listings.republish', $listing) }}">
                                            @csrf
                                            <button type="submit" class="listings-dashboard-text-button">
                                                Yeniden Yayınla
                                            </button>
                                        </form>
                                    @elseif ($listing->statusValue() !== 'sold')
                                        <form method="POST" action="{{ route('panel.listings.mark-sold', $listing) }}">
                                            @csrf
                                            <button type="submit" class="listings-dashboard-text-button">
                                                Satıldı İşaretle
                                            </button>
                                        </form>
                                    @endif

                                    <form method="POST" action="{{ route('panel.listings.destroy', $listing) }}">
                                        @csrf
                                        <button type="submit" class="listings-dashboard-text-button is-danger">
                                            İlanı Kaldır
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <aside class="listings-dashboard-aside">
                            <p class="listings-dashboard-price">{{ $priceLabel }}</p>
                            <p class="mt-3 text-sm leading-6 text-slate-500">{{ $statusMeta['hint'] }}</p>
                        </aside>
                    </article>
                @empty
                    <div class="listings-dashboard-empty">
                        <p class="account-section-kicker">Boş durum</p>
                        <h2 class="mt-2 text-2xl font-semibold tracking-[-0.03em] text-slate-950">Bu filtreye uygun ilan bulunamadı</h2>
                        <p class="mt-3 max-w-xl text-sm leading-6 text-slate-500">
                            Arama terimini temizleyebilir, farklı bir durum seçebilir veya yeni ilan oluşturarak bu alanı doldurabilirsin.
                        </p>
                        <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                            @if ($hasFilters)
                                <a href="{{ route('panel.listings.index') }}" class="account-secondary-button">Filtreleri Temizle</a>
                            @endif

                            <a href="{{ route('panel.listings.create') }}" class="account-primary-button">Yeni İlan Ver</a>
                        </div>
                    </div>
                @endforelse
            </div>

            @if ($listings->hasPages())
                <div class="mt-5">
                    {{ $listings->links() }}
                </div>
            @endif
        </section>
    </div>
</div>
@endsection
