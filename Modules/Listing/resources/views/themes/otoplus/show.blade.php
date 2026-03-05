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
