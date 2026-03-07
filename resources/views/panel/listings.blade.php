@extends('app::layouts.app')

@section('title', 'İlanlarım')

@section('content')
<div class="max-w-[1320px] mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-[220px,1fr] gap-4">
        @include('panel.partials.sidebar', ['activeMenu' => 'listings'])

        <section class="panel-surface">
            <div class="panel-toolbar">
                <form method="GET" action="{{ route('panel.listings.index') }}" class="panel-search">
                    <svg class="panel-search-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-4.35-4.35m1.6-5.05a7.25 7.25 0 11-14.5 0 7.25 7.25 0 0114.5 0z"/>
                    </svg>
                    <input type="text" name="search" value="{{ $search }}" placeholder="İlan başlığına göre ara" class="panel-search-input focus:outline-none focus:ring-2 focus:ring-rose-200">
                    <input type="hidden" name="status" value="{{ $status }}">
                </form>

                <div class="panel-filter-tabs">
                    <a href="{{ route('panel.listings.index', ['search' => $search, 'status' => 'all']) }}" class="panel-filter-tab {{ $status === 'all' ? 'is-active' : '' }}">
                        Tüm İlanlar ({{ $counts['all'] }})
                    </a>
                    <a href="{{ route('panel.listings.index', ['search' => $search, 'status' => 'sold']) }}" class="panel-filter-tab {{ $status === 'sold' ? 'is-active' : '' }}">
                        Satıldı ({{ $counts['sold'] }})
                    </a>
                    <a href="{{ route('panel.listings.index', ['search' => $search, 'status' => 'expired']) }}" class="panel-filter-tab {{ $status === 'expired' ? 'is-active' : '' }}">
                        Süresi Dolmuş ({{ $counts['expired'] }})
                    </a>
                </div>
            </div>

            <div class="space-y-4 panel-list-section">
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
                    $videoCount = (int) ($listing->videos_count ?? 0);
                    $readyVideoCount = (int) ($listing->ready_videos_count ?? 0);
                    $pendingVideoCount = (int) ($listing->pending_videos_count ?? 0);
                @endphp
                <article class="panel-list-card">
                    <div class="panel-list-card-body">
                        <div class="panel-list-media bg-slate-200">
                            @if($listingImage)
                            <img src="{{ $listingImage }}" alt="{{ $listing->title }}" class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full grid place-items-center text-slate-400">Görsel yok</div>
                            @endif
                        </div>

                        <div class="panel-list-main">
                            <div class="panel-list-summary">
                                <p class="panel-list-price text-slate-900">{{ $priceLabel }}</p>
                                <span class="panel-status-badge {{ $statusBadgeClass }}">{{ $statusLabel }}</span>
                            </div>
                            <h2 class="panel-list-title text-slate-800">{{ $listing->title }}</h2>

                            <div class="panel-list-actions">
                                @if(Route::has('filament.partner.resources.listings.edit'))
                                <a href="{{ route('filament.partner.resources.listings.edit', ['tenant' => auth()->id(), 'record' => $listing]) }}" class="panel-action-btn panel-action-btn-secondary">
                                    İlanı Düzenle
                                </a>
                                @endif

                                <form method="POST" action="{{ route('panel.listings.destroy', $listing) }}">
                                    @csrf
                                    <button type="submit" class="panel-action-btn panel-action-btn-secondary">
                                        İlanı Kaldır
                                    </button>
                                </form>

                                @if((string) $listing->status !== 'sold')
                                <form method="POST" action="{{ route('panel.listings.mark-sold', $listing) }}">
                                    @csrf
                                    <button type="submit" class="panel-action-btn panel-action-btn-primary">
                                        Satıldı İşaretle
                                    </button>
                                </form>
                                @endif

                                @if((string) $listing->status === 'expired')
                                <form method="POST" action="{{ route('panel.listings.republish', $listing) }}">
                                    @csrf
                                    <button type="submit" class="panel-action-btn panel-action-btn-secondary">
                                        Yeniden Yayınla
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>

                        <div class="panel-list-aside">
                            <div class="panel-stats">
                                <div class="panel-stat-box">
                                    <span>👁</span>
                                    <span>{{ $viewCount }}</span>
                                </div>
                                <div class="panel-stat-box">
                                    <span>♥</span>
                                    <span>{{ $favoriteCount }}</span>
                                </div>
                            </div>

                            <p class="panel-list-dates">
                                Yayın Tarihi & Bitiş Tarihi:
                                <strong class="text-slate-700">
                                    {{ $listing->created_at?->format('d/m/Y') ?? '-' }} - {{ $expiresAt ?: '-' }}
                                </strong>
                            </p>

                            <p class="panel-list-dates">
                                Video Durumu:
                                <strong class="text-slate-700">
                                    {{ $videoCount }} toplam, {{ $readyVideoCount }} hazır, {{ $pendingVideoCount }} işleniyor
                                </strong>
                            </p>
                        </div>
                    </div>

                    @if((string) $listing->status === 'expired')
                    <div class="panel-inline-note">
                        <strong>Bu ilanın süresi doldu.</strong> Eğer sattıysan, lütfen satıldı olarak işaretle.
                    </div>
                    @endif
                </article>
                @empty
                <div class="panel-empty-state">
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
