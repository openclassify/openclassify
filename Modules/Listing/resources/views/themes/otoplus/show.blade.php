@extends('app::layouts.app')

@section('content')
@php
    $title = trim((string) ($listing->title ?? ''));
    $displayTitle = $title !== '' ? $title : 'İlan başlığı yok';

    $priceLabel = 'Fiyat sorunuz';
    if (! is_null($listing->price)) {
        $priceValue = (float) $listing->price;
        $priceLabel = $priceValue > 0
            ? number_format($priceValue, 0, ',', '.').' '.($listing->currency ?: 'TL')
            : 'Ücretsiz';
    }

    $locationLabel = collect([$listing->city, $listing->country])
        ->filter(fn ($value) => is_string($value) && trim($value) !== '')
        ->implode(', ');

    $publishedAt = $listing->created_at?->format('d M Y');
    $galleryImages = collect($gallery ?? [])->values()->all();
    $initialGalleryImage = $galleryImages[0] ?? null;

    $sellerName = trim((string) ($listing->user?->name ?? 'Satıcı'));
    $sellerInitial = strtoupper(substr($sellerName, 0, 1));
    $sellerMemberText = $listing->user?->created_at
        ? $listing->user->created_at->format('M Y').' tarihinden beri üye'
        : 'Yeni üye';
@endphp

<style>
    .lt-wrap { max-width: 1320px; margin: 0 auto; padding: 24px 16px 46px; }
    .lt-breadcrumb { display: flex; flex-wrap: wrap; gap: 8px; font-size: 13px; color: #6b7280; margin-bottom: 14px; }
    .lt-breadcrumb a { color: #4b5563; text-decoration: none; }
    .lt-breadcrumb span:last-child { color: #111827; font-weight: 700; }
    .lt-grid { display: grid; grid-template-columns: minmax(0, 1fr) 352px; gap: 18px; align-items: start; }
    .lt-card { border: 1px solid #d8dce4; border-radius: 14px; background: #f7f7f8; box-shadow: 0 1px 2px rgba(16, 24, 40, .05); }

    .lt-gallery-main { position: relative; border-radius: 10px; background: #1f2937; overflow: hidden; min-height: 440px; }
    .lt-gallery-main img { width: 100%; height: 100%; object-fit: cover; min-height: 440px; }
    .lt-gallery-main-empty { min-height: 440px; display: grid; place-items: center; color: #cbd5e1; font-size: 14px; }
    .lt-gallery-nav { position: absolute; top: 50%; transform: translateY(-50%); width: 44px; height: 44px; border: 0; border-radius: 999px; background: rgba(255,255,255,.92); color: #111827; display: grid; place-items: center; cursor: pointer; }
    .lt-gallery-nav[data-gallery-prev] { left: 14px; }
    .lt-gallery-nav[data-gallery-next] { right: 14px; }
    .lt-gallery-top { position: absolute; top: 12px; left: 12px; right: 12px; display: flex; justify-content: space-between; align-items: center; }
    .lt-badge { border-radius: 999px; background: #ffd814; color: #111827; font-size: 12px; font-weight: 700; padding: 6px 10px; }
    .lt-icon-btn { width: 38px; height: 38px; border: 0; border-radius: 999px; background: rgba(17, 24, 39, .86); color: #fff; display: inline-flex; align-items: center; justify-content: center; }

    .lt-thumbs { display: flex; gap: 10px; overflow-x: auto; padding: 12px 0 2px; }
    .lt-thumb { width: 86px; min-width: 86px; height: 64px; border: 2px solid transparent; border-radius: 10px; overflow: hidden; background: #d1d5db; cursor: pointer; }
    .lt-thumb.is-active { border-color: #ff3a59; }
    .lt-thumb img { width: 100%; height: 100%; object-fit: cover; }

    .lt-media-card { padding: 14px; }
    .lt-detail-card { margin-top: 14px; padding: 18px 20px; }
    .lt-price-row { display: flex; flex-wrap: wrap; gap: 12px; justify-content: space-between; align-items: flex-start; }
    .lt-price { font-size: 46px; line-height: 1; font-weight: 900; color: #0f172a; }
    .lt-title { margin-top: 8px; font-size: 21px; font-weight: 700; color: #111827; }
    .lt-meta { text-align: right; color: #4b5563; font-size: 14px; }
    .lt-meta strong { color: #111827; font-weight: 700; }

    .lt-credit { margin-top: 14px; border: 1px solid #e3e7ee; border-radius: 12px; padding: 14px; background: #fafafb; display: flex; align-items: center; justify-content: space-between; gap: 12px; }
    .lt-credit h4 { margin: 0; font-size: 20px; color: #0f172a; }
    .lt-credit p { margin: 3px 0 0; font-size: 14px; color: #4b5563; }
    .lt-tag { border-radius: 999px; background: #2f80ed; color: #fff; font-size: 13px; font-weight: 700; padding: 7px 12px; }

    .lt-section-title { margin: 18px 0 10px; font-size: 30px; font-weight: 900; color: #111827; }
    .lt-features { border-top: 1px solid #e2e8f0; margin-top: 12px; }
    .lt-feature-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; border-top: 1px solid #e7ebf2; padding: 12px 0; }
    .lt-feature-row:first-child { border-top: 0; }
    .lt-f-item { display: flex; justify-content: space-between; gap: 8px; color: #334155; font-size: 15px; }
    .lt-f-item strong { color: #111827; font-weight: 800; text-align: right; }

    .lt-side-card { position: sticky; top: 96px; padding: 16px; }
    .lt-seller-head { display: flex; align-items: center; gap: 10px; }
    .lt-avatar { width: 44px; height: 44px; border-radius: 999px; background: #f3f4f6; color: #111827; display: grid; place-items: center; font-weight: 800; }
    .lt-seller-name { margin: 0; font-size: 31px; font-weight: 800; color: #111827; line-height: 1.1; }
    .lt-seller-meta { margin-top: 2px; font-size: 13px; color: #6b7280; }

    .lt-actions { margin-top: 14px; display: grid; gap: 10px; }
    .lt-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
    .lt-btn { height: 46px; border-radius: 999px; border: 1px solid #f3ced6; background: #f8e6ea; color: #e11d48; font-size: 20px; font-weight: 800; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 6px; cursor: pointer; }
    .lt-btn:disabled { opacity: .45; cursor: not-allowed; }
    .lt-btn-main { border: 0; background: #ff3a59; color: #fff; width: 100%; }
    .lt-btn-soft { border-color: #efdde1; background: #f5eaed; }
    .lt-btn-outline { border-color: #d4d8e0; background: #fff; color: #334155; }

    .lt-report { margin-top: 16px; height: 54px; border: 1px solid #e3e7ee; border-radius: 999px; background: #f7f7f8; color: #e11d48; font-size: 16px; font-weight: 700; display: grid; place-items: center; text-decoration: none; }
    .lt-policy { margin-top: 16px; text-align: center; color: #6b7280; font-size: 13px; }

    .lt-related { margin-top: 26px; }
    .lt-related-head { display: flex; justify-content: space-between; align-items: center; }
    .lt-related-title { font-size: 30px; font-weight: 900; margin: 0; }
    .lt-scroll-wrap { position: relative; margin-top: 14px; }
    .lt-scroll-track { display: flex; gap: 12px; overflow-x: auto; scroll-behavior: smooth; padding: 2px 2px 8px; }
    .lt-rel-card { min-width: 232px; width: 232px; border: 1px solid #d8dce4; border-radius: 10px; background: #f7f7f8; overflow: hidden; text-decoration: none; color: inherit; }
    .lt-rel-photo { height: 168px; background: #d1d5db; }
    .lt-rel-photo img { width: 100%; height: 100%; object-fit: cover; }
    .lt-rel-body { padding: 10px; }
    .lt-rel-price { font-size: 32px; font-weight: 900; color: #111827; line-height: 1.1; }
    .lt-rel-title { margin-top: 4px; font-size: 20px; font-weight: 700; color: #111827; line-height: 1.3; min-height: 52px; }
    .lt-rel-city { margin-top: 6px; font-size: 13px; color: #6b7280; }

    .lt-scroll-btn { position: absolute; top: 42%; transform: translateY(-50%); width: 44px; height: 44px; border: 0; border-radius: 999px; background: rgba(255,255,255,.92); box-shadow: 0 1px 4px rgba(15,23,42,.18); display: grid; place-items: center; cursor: pointer; }
    .lt-scroll-btn.prev { left: -16px; }
    .lt-scroll-btn.next { right: -16px; }

    .lt-pill-wrap { margin-top: 20px; }
    .lt-pill-title { margin: 0 0 10px; font-size: 30px; font-weight: 900; }
    .lt-pills { display: flex; flex-wrap: wrap; gap: 10px; }
    .lt-pill { border: 1px solid #d4d8e0; background: #f4f5f7; border-radius: 999px; padding: 8px 14px; color: #374151; text-decoration: none; font-size: 14px; font-weight: 600; }

    @media (max-width: 1080px) {
        .lt-grid { grid-template-columns: 1fr; }
        .lt-side-card { position: static; }
        .lt-scroll-btn { display: none; }
        .lt-price { font-size: 39px; }
        .lt-seller-name, .lt-section-title, .lt-related-title, .lt-pill-title { font-size: 24px; }
    }

    @media (max-width: 640px) {
        .lt-wrap { padding: 16px 10px 30px; }
        .lt-detail-card, .lt-media-card, .lt-side-card { padding: 12px; }
        .lt-gallery-main, .lt-gallery-main img, .lt-gallery-main-empty { min-height: 260px; }
        .lt-feature-row { grid-template-columns: 1fr; gap: 10px; }
        .lt-price-row { flex-direction: column; }
        .lt-meta { text-align: left; }
        .lt-rel-card { min-width: 196px; width: 196px; }
        .lt-rel-photo { height: 140px; }
    }
</style>

<div class="lt-wrap">
    <nav class="lt-breadcrumb" aria-label="breadcrumb">
        <a href="{{ route('home') }}">Anasayfa</a>
        @foreach(($breadcrumbCategories ?? collect()) as $crumb)
            <span>›</span>
            <a href="{{ route('categories.show', $crumb) }}">{{ $crumb->name }}</a>
        @endforeach
        <span>›</span>
        <span>{{ $displayTitle }}</span>
    </nav>

    <div class="lt-grid">
        <div>
            <section class="lt-card lt-media-card" data-gallery>
                <div class="lt-gallery-main">
                    <div class="lt-gallery-top">
                        <span class="lt-badge">Öne Çıkan</span>
                        @auth
                            <form method="POST" action="{{ route('favorites.listings.toggle', $listing) }}">
                                @csrf
                                <button type="submit" class="lt-icon-btn" aria-label="Favoriye ekle">
                                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 21l-1.4-1.3C5.4 15 2 12 2 8.4 2 5.5 4.3 3.2 7.2 3.2c1.7 0 3.3.8 4.4 2.1 1.1-1.3 2.8-2.1 4.4-2.1C18.9 3.2 21.2 5.5 21.2 8.4c0 3.6-3.4 6.6-8.6 11.3L12 21z"/></svg>
                                </button>
                            </form>
                        @endauth
                    </div>

                    @if($initialGalleryImage)
                        <img src="{{ $initialGalleryImage }}" alt="{{ $displayTitle }}" data-gallery-main>
                    @else
                        <div class="lt-gallery-main-empty" data-gallery-main-empty>Görsel bulunamadı</div>
                    @endif

                    @if(count($galleryImages) > 1)
                        <button type="button" class="lt-gallery-nav" data-gallery-prev aria-label="Önceki">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
                        </button>
                        <button type="button" class="lt-gallery-nav" data-gallery-next aria-label="Sonraki">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m9 18 6-6-6-6"/></svg>
                        </button>
                    @endif
                </div>

                @if($galleryImages !== [])
                    <div class="lt-thumbs" data-gallery-thumbs>
                        @foreach($galleryImages as $index => $image)
                            <button
                                type="button"
                                class="lt-thumb {{ $index === 0 ? 'is-active' : '' }}"
                                data-gallery-thumb
                                data-gallery-index="{{ $index }}"
                                data-gallery-src="{{ $image }}"
                            >
                                <img src="{{ $image }}" alt="{{ $displayTitle }} {{ $index + 1 }}">
                            </button>
                        @endforeach
                    </div>
                @endif
            </section>

            <section class="lt-card lt-detail-card">
                <div class="lt-price-row">
                    <div>
                        <div class="lt-price">{{ $priceLabel }}</div>
                        <div class="lt-title">{{ $displayTitle }}</div>
                    </div>
                    <div class="lt-meta">
                        <div><strong>{{ $locationLabel !== '' ? $locationLabel : 'Konum belirtilmedi' }}</strong></div>
                        <div>{{ $publishedAt ?? '-' }}</div>
                    </div>
                </div>

                <div class="lt-credit">
                    <div>
                        <h4>Acil kredi mi lazım?</h4>
                        <p>Kredi fırsatlarını hemen incele.</p>
                    </div>
                    <span class="lt-tag">Yeni</span>
                </div>

                <h2 class="lt-section-title">İlan Özellikleri</h2>
                <div class="lt-features">
                    <div class="lt-feature-row">
                        <div class="lt-f-item"><span>İlan No</span><strong>{{ $listing->id }}</strong></div>
                        <div class="lt-f-item"><span>Marka</span><strong>{{ $listing->category?->name ?? '-' }}</strong></div>
                    </div>
                    <div class="lt-feature-row">
                        <div class="lt-f-item"><span>Model</span><strong>{{ $listing->slug ?? '-' }}</strong></div>
                        <div class="lt-f-item"><span>Yayın Tarihi</span><strong>{{ $publishedAt ?? '-' }}</strong></div>
                    </div>
                    @foreach(($presentableCustomFields ?? []) as $chunk)
                        <div class="lt-feature-row">
                            <div class="lt-f-item"><span>{{ $chunk['label'] ?? '-' }}</span><strong>{{ $chunk['value'] ?? '-' }}</strong></div>
                            <div class="lt-f-item"><span>Konum</span><strong>{{ $locationLabel !== '' ? $locationLabel : '-' }}</strong></div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>

        <aside class="lt-card lt-side-card">
            <div class="lt-seller-head">
                <div class="lt-avatar">{{ $sellerInitial !== '' ? $sellerInitial : 'S' }}</div>
                <div>
                    <p class="lt-seller-name">{{ $sellerName }}</p>
                    <div class="lt-seller-meta">{{ $sellerMemberText }}</div>
                </div>
            </div>

            <div class="lt-actions">
                <div class="lt-row-2">
                    @if($listing->user && auth()->check() && (int) auth()->id() !== (int) $listing->user_id)
                        @if($existingConversationId)
                            <a href="{{ route('panel.inbox.index', ['conversation' => $existingConversationId]) }}" class="lt-btn">Sohbet</a>
                        @else
                            <form method="POST" action="{{ route('conversations.start', $listing) }}">
                                @csrf
                                <button type="submit" class="lt-btn" style="width:100%;">Sohbet</button>
                            </form>
                        @endif
                    @else
                        @if(auth()->check())
                            <button type="button" class="lt-btn" disabled>Sohbet</button>
                        @else
                            <a href="{{ route('login') }}" class="lt-btn">Sohbet</a>
                        @endif
                    @endif

                    @if($listing->contact_phone)
                        <a href="tel:{{ preg_replace('/\s+/', '', (string) $listing->contact_phone) }}" class="lt-btn lt-btn-soft">Ara</a>
                    @else
                        <button type="button" class="lt-btn lt-btn-soft" disabled>Ara</button>
                    @endif
                </div>

                @if($listing->user && auth()->check() && (int) auth()->id() !== (int) $listing->user_id)
                    @if($existingConversationId)
                        <a href="{{ route('panel.inbox.index', ['conversation' => $existingConversationId]) }}" class="lt-btn lt-btn-main">Teklif Yap</a>
                    @else
                        <form method="POST" action="{{ route('conversations.start', $listing) }}">
                            @csrf
                            <button type="submit" class="lt-btn lt-btn-main">Teklif Yap</button>
                        </form>
                    @endif
                @else
                    <button type="button" class="lt-btn lt-btn-main" disabled>Teklif Yap</button>
                @endif

                <div class="lt-row-2">
                    <a href="#" class="lt-btn lt-btn-outline">Harita</a>
                    @if($listing->user)
                        <a href="{{ route('favorites.index', ['tab' => 'sellers']) }}" class="lt-btn lt-btn-outline">Satıcı Profili</a>
                    @else
                        <a href="#" class="lt-btn lt-btn-outline">Satıcı Profili</a>
                    @endif
                </div>
            </div>

            <a href="#" class="lt-report">İlan ile ilgili şikayetim var</a>
            <div class="lt-policy">İade ve Geri Ödeme Politikası</div>
        </aside>
    </div>

    <section class="lt-related">
        <div class="lt-related-head">
            <h3 class="lt-related-title">İlgini çekebilecek diğer ilanlar</h3>
        </div>

        <div class="lt-scroll-wrap" data-theme-scroll>
            <button type="button" class="lt-scroll-btn prev" data-theme-scroll-prev aria-label="Önceki">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
            </button>

            <div class="lt-scroll-track" data-theme-scroll-track>
                @foreach(($relatedListings ?? collect()) as $related)
                    @php
                        $relatedImage = $related->getFirstMediaUrl('listing-images');
                        if (! $relatedImage && is_array($related->images ?? null)) {
                            $relatedImage = collect($related->images)->first();
                        }
                        $relatedPrice = ! is_null($related->price)
                            ? (((float) $related->price > 0) ? number_format((float) $related->price, 0, ',', '.').' '.($related->currency ?: 'TL') : 'Ücretsiz')
                            : 'Fiyat sorunuz';
                    @endphp
                    <a href="{{ route('listings.show', $related) }}" class="lt-rel-card">
                        <div class="lt-rel-photo">
                            @if($relatedImage)
                                <img src="{{ $relatedImage }}" alt="{{ $related->title }}">
                            @endif
                        </div>
                        <div class="lt-rel-body">
                            <div class="lt-rel-price">{{ $relatedPrice }}</div>
                            <div class="lt-rel-title">{{ $related->title }}</div>
                            <div class="lt-rel-city">{{ trim(collect([$related->city, $related->country])->filter()->implode(', ')) }}</div>
                        </div>
                    </a>
                @endforeach
            </div>

            <button type="button" class="lt-scroll-btn next" data-theme-scroll-next aria-label="Sonraki">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m9 18 6-6-6-6"/></svg>
            </button>
        </div>

        <div class="lt-pill-wrap">
            <h4 class="lt-pill-title">Daha fazla kategori</h4>
            <div class="lt-pills">
                @foreach(($themePillCategories ?? collect()) as $pillCategory)
                    <a href="{{ route('listings.index', ['category' => $pillCategory->id]) }}" class="lt-pill">{{ $pillCategory->name }}</a>
                @endforeach
            </div>
        </div>
    </section>
</div>

<script>
    (() => {
        document.querySelectorAll('[data-gallery]').forEach((galleryRoot) => {
            const mainImage = galleryRoot.querySelector('[data-gallery-main]');
            const thumbButtons = Array.from(galleryRoot.querySelectorAll('[data-gallery-thumb]'));
            const prevButton = galleryRoot.querySelector('[data-gallery-prev]');
            const nextButton = galleryRoot.querySelector('[data-gallery-next]');

            if (!mainImage || thumbButtons.length === 0) {
                return;
            }

            let activeIndex = thumbButtons.findIndex((button) => button.classList.contains('is-active'));
            if (activeIndex < 0) {
                activeIndex = 0;
                thumbButtons[0].classList.add('is-active');
            }

            const activate = (index) => {
                if (index < 0 || index >= thumbButtons.length) {
                    return;
                }

                activeIndex = index;
                const src = thumbButtons[index].dataset.gallerySrc;
                if (src) {
                    mainImage.src = src;
                }

                thumbButtons.forEach((button, buttonIndex) => {
                    button.classList.toggle('is-active', buttonIndex === activeIndex);
                });
            };

            thumbButtons.forEach((button, index) => {
                button.addEventListener('click', () => activate(index));
            });

            prevButton?.addEventListener('click', () => {
                activate((activeIndex - 1 + thumbButtons.length) % thumbButtons.length);
            });

            nextButton?.addEventListener('click', () => {
                activate((activeIndex + 1) % thumbButtons.length);
            });
        });

        document.querySelectorAll('[data-theme-scroll]').forEach((scrollRoot) => {
            const track = scrollRoot.querySelector('[data-theme-scroll-track]');
            const prev = scrollRoot.querySelector('[data-theme-scroll-prev]');
            const next = scrollRoot.querySelector('[data-theme-scroll-next]');

            if (!track) {
                return;
            }

            const amount = () => Math.max(280, Math.floor(track.clientWidth * 0.72));

            prev?.addEventListener('click', () => {
                track.scrollBy({ left: -amount(), behavior: 'smooth' });
            });

            next?.addEventListener('click', () => {
                track.scrollBy({ left: amount(), behavior: 'smooth' });
            });
        });
    })();
</script>
@endsection
