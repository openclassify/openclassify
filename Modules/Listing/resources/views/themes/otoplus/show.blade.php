@extends('app::layouts.app')

@section('content')
@php
    $title = trim((string) ($listing->title ?? ''));
    $displayTitle = $title !== '' ? $title : 'Untitled listing';

    $priceLabel = 'Price on request';
    if (! is_null($listing->price)) {
        $priceValue = (float) $listing->price;
        $formattedPrice = number_format($priceValue, 2, '.', ',');
        $formattedPrice = rtrim(rtrim($formattedPrice, '0'), '.');
        $priceLabel = $priceValue > 0
            ? $formattedPrice.' '.($listing->currency ?: 'TRY')
            : 'Free';
    }

    $locationLabel = collect([$listing->city, $listing->country])
        ->filter(fn ($value) => is_string($value) && trim($value) !== '')
        ->implode(' / ');

    $publishedAt = $listing->created_at?->format('M j, Y') ?? 'Recently';
    $postedAgo = $listing->created_at?->diffForHumans() ?? 'Listed recently';
    $galleryImages = collect($gallery ?? [])
        ->filter(fn ($value) => is_string($value) && trim($value) !== '')
        ->values()
        ->all();
    $initialGalleryImage = $galleryImages[0] ?? null;
    $galleryCount = count($galleryImages);

    $description = trim((string) ($listing->description ?? ''));
    $displayDescription = $description !== '' ? $description : 'No description added for this listing.';

    $sellerName = trim((string) ($listing->user?->name ?? 'Marketplace Seller'));
    $sellerInitial = mb_strtoupper(mb_substr($sellerName, 0, 1));
    $sellerMemberText = $listing->user?->created_at
        ? 'Member since '.$listing->user->created_at->format('M Y')
        : 'New seller';

    $referenceCode = '#'.str_pad((string) $listing->getKey(), 8, '0', STR_PAD_LEFT);
    $canContactSeller = $listing->user && (! auth()->check() || (int) auth()->id() !== (int) $listing->user_id);
    $isOwnListing = auth()->check() && (int) auth()->id() === (int) $listing->user_id;

    $primaryContactHref = null;
    $primaryContactLabel = 'Call';
    if (filled($listing->contact_phone)) {
        $primaryContactHref = 'tel:'.preg_replace('/\s+/', '', (string) $listing->contact_phone);
        $primaryContactLabel = 'Call';
    } elseif (filled($listing->contact_email)) {
        $primaryContactHref = 'mailto:'.$listing->contact_email;
        $primaryContactLabel = 'Email';
    }

    $mapQuery = filled($listing->latitude) && filled($listing->longitude)
        ? trim((string) $listing->latitude).','.trim((string) $listing->longitude)
        : str_replace(' / ', ', ', $locationLabel);
    $mapUrl = $mapQuery !== ''
        ? 'https://www.google.com/maps/search/?api=1&query='.urlencode($mapQuery)
        : null;

    $reportEmail = config('mail.from.address', 'support@example.com');
    $reportUrl = 'mailto:'.$reportEmail.'?subject='.rawurlencode('Report listing '.$referenceCode);
    $shareUrl = route('listings.show', $listing);

    $specRows = collect([
        ['label' => 'Price', 'value' => $priceLabel],
        ['label' => 'Published', 'value' => $publishedAt],
        ['label' => 'Listing ID', 'value' => $referenceCode],
        ['label' => 'Category', 'value' => $listing->category?->name ?? 'General'],
        ['label' => 'Location', 'value' => $locationLabel !== '' ? str_replace(' / ', ' / ', $locationLabel) : 'Not specified'],
    ])
        ->merge(
            collect($presentableCustomFields ?? [])->map(fn (array $field) => [
                'label' => trim((string) ($field['label'] ?? '')),
                'value' => trim((string) ($field['value'] ?? '')),
            ])
        )
        ->filter(fn (array $item) => $item['label'] !== '' && $item['value'] !== '')
        ->unique(fn (array $item) => mb_strtolower($item['label']))
        ->values();
@endphp

<div class="lt-wrap">
    <nav class="lt-breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        @foreach(($breadcrumbCategories ?? collect()) as $crumb)
            <span>/</span>
            <a href="{{ route('listings.index', ['category' => $crumb->id]) }}">{{ $crumb->name }}</a>
        @endforeach
        <span>/</span>
        <span>{{ $displayTitle }}</span>
    </nav>

    <section class="lt-card lt-hero-card">
        <div class="lt-hero-main">
            <div class="lt-hero-copy">
                <p class="lt-overline">{{ $listing->category?->name ?? 'Marketplace listing' }}</p>
                <h1 class="lt-hero-title">{{ $displayTitle }}</h1>
                <div class="lt-hero-meta">
                    <span>{{ $referenceCode }}</span>
                    <span>{{ $sellerName }}</span>
                    <span>{{ $postedAgo }}</span>
                </div>
            </div>

            <div class="lt-hero-side">
                <div class="lt-hero-price">{{ $priceLabel }}</div>
                @if($locationLabel !== '')
                    <div class="lt-address-chip">{{ $locationLabel }}</div>
                @endif

                <div class="lt-hero-tools">
                    <button
                        type="button"
                        class="lt-link-action"
                        data-listing-share
                        data-share-url="{{ $shareUrl }}"
                        data-share-title="{{ $displayTitle }}"
                    >
                        Share
                    </button>

                    @auth
                        <form method="POST" action="{{ route('favorites.listings.toggle', $listing) }}" class="lt-inline-form">
                            @csrf
                            <button type="submit" class="lt-link-action">
                                {{ $isListingFavorited ? 'Saved' : 'Save listing' }}
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="lt-link-action">Save listing</a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    <div class="lt-grid">
        <div class="lt-main-column">
            <div class="lt-media-spec-grid">
                <section class="lt-card lt-media-card" data-gallery>
                    <div class="lt-gallery-main">
                        <div class="lt-gallery-top">
                            <div class="lt-gallery-spacer"></div>

                            <div class="lt-gallery-utility">
                                <button
                                    type="button"
                                    class="lt-icon-btn"
                                    data-listing-share
                                    data-share-url="{{ $shareUrl }}"
                                    data-share-title="{{ $displayTitle }}"
                                    aria-label="Share listing"
                                >
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9">
                                        <path d="M15 8a3 3 0 1 0-2.83-4H12a3 3 0 0 0 .17 1L8.91 6.94a3 3 0 0 0-1.91-.69 3 3 0 1 0 1.91 5.31l3.27 1.94A3 3 0 0 0 12 15a3 3 0 1 0 2.82 4H15a3 3 0 0 0-.17-1l-3.26-1.94a3 3 0 0 0 0-3.12L14.83 10A3 3 0 0 0 15 10h0a3 3 0 0 0 0-2Z"/>
                                    </svg>
                                </button>

                                @auth
                                    <form method="POST" action="{{ route('favorites.listings.toggle', $listing) }}">
                                        @csrf
                                        <button
                                            type="submit"
                                            class="lt-icon-btn {{ $isListingFavorited ? 'is-active' : '' }}"
                                            aria-label="{{ $isListingFavorited ? 'Remove from saved listings' : 'Save listing' }}"
                                        >
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9">
                                                <path d="M12 21l-1.45-1.32C5.4 15.03 2 12.01 2 8.31 2 5.3 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.08A6.04 6.04 0 0116.5 3C19.58 3 22 5.3 22 8.31c0 3.7-3.4 6.72-8.55 11.39L12 21z"/>
                                            </svg>
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="lt-icon-btn" aria-label="Sign in to save this listing">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9">
                                            <path d="M12 21l-1.45-1.32C5.4 15.03 2 12.01 2 8.31 2 5.3 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.08A6.04 6.04 0 0116.5 3C19.58 3 22 5.3 22 8.31c0 3.7-3.4 6.72-8.55 11.39L12 21z"/>
                                        </svg>
                                    </a>
                                @endauth
                            </div>
                        </div>

                        @if($initialGalleryImage)
                            <img src="{{ $initialGalleryImage }}" alt="{{ $displayTitle }}" data-gallery-main>
                        @else
                            <div class="lt-gallery-main-empty">No photos uploaded yet.</div>
                        @endif

                        @if($galleryCount > 1)
                            <button type="button" class="lt-gallery-nav" data-gallery-prev aria-label="Previous photo">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="m15 18-6-6 6-6"/>
                                </svg>
                            </button>
                            <button type="button" class="lt-gallery-nav" data-gallery-next aria-label="Next photo">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="m9 18 6-6-6-6"/>
                                </svg>
                            </button>
                        @endif

                        @if($galleryCount > 0)
                            <div class="lt-gallery-count">
                                <span data-gallery-current>1</span> / <span>{{ $galleryCount }}</span>
                            </div>
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
                                    aria-label="Open photo {{ $index + 1 }}"
                                >
                                    <img src="{{ $image }}" alt="{{ $displayTitle }} {{ $index + 1 }}">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </section>

                <div class="lt-info-column">
                    <section class="lt-card lt-spec-card lt-desktop-only">
                        <div class="lt-card-head">
                            <div>
                                <h2 class="lt-section-title">Listing details</h2>
                                <p class="lt-section-copy">Everything important, laid out cleanly.</p>
                            </div>
                        </div>

                        @if($locationLabel !== '')
                            <div class="lt-address-chip lt-address-chip-soft">{{ $locationLabel }}</div>
                        @endif

                        <div class="lt-spec-table">
                            @foreach($specRows as $row)
                                <div class="lt-spec-row">
                                    <span>{{ $row['label'] }}</span>
                                    <strong>{{ $row['value'] }}</strong>
                                </div>
                            @endforeach
                        </div>

                        <a href="{{ $reportUrl }}" class="lt-inline-link">Report this listing</a>
                    </section>

                    <section class="lt-card lt-description-card lt-desktop-only">
                        <div class="lt-card-head">
                            <div>
                                <h2 class="lt-section-title">Description</h2>
                                <p class="lt-section-copy">Seller notes, condition, and extra context.</p>
                            </div>
                        </div>

                        <div class="lt-description">
                            {!! nl2br(e($displayDescription)) !!}
                        </div>
                    </section>
                </div>
            </div>

            <section class="lt-card lt-mobile-seller-card lt-mobile-only">
                <div class="lt-mobile-seller-row">
                    <div class="lt-avatar">{{ $sellerInitial !== '' ? $sellerInitial : 'S' }}</div>
                    <div>
                        <p class="lt-mobile-seller-name">{{ $sellerName }}</p>
                        <p class="lt-mobile-seller-meta">{{ $sellerMemberText }}</p>
                    </div>
                </div>
            </section>

            <section class="lt-card lt-mobile-tabs lt-mobile-only" data-detail-tabs>
                <div class="lt-tab-list" role="tablist" aria-label="Listing sections">
                    <button type="button" class="lt-tab-button is-active" data-detail-tab-button data-tab="details" role="tab" aria-selected="true">
                        Listing details
                    </button>
                    <button type="button" class="lt-tab-button" data-detail-tab-button data-tab="description" role="tab" aria-selected="false">
                        Description
                    </button>
                </div>

                <div class="lt-tab-panel is-active" data-detail-tab-panel data-panel="details" role="tabpanel">
                    @if($locationLabel !== '')
                        <div class="lt-address-chip lt-address-chip-soft">{{ $locationLabel }}</div>
                    @endif

                    <div class="lt-spec-table">
                        @foreach($specRows as $row)
                            <div class="lt-spec-row">
                                <span>{{ $row['label'] }}</span>
                                <strong>{{ $row['value'] }}</strong>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="lt-tab-panel" data-detail-tab-panel data-panel="description" role="tabpanel">
                    <div class="lt-description">
                        {!! nl2br(e($displayDescription)) !!}
                    </div>
                </div>
            </section>

            @if(($listingVideos ?? collect())->isNotEmpty())
                <section class="lt-card lt-video-section">
                    <div class="lt-card-head">
                        <div>
                            <h2 class="lt-section-title">Videos</h2>
                            <p class="lt-section-copy">Additional media attached to the listing.</p>
                        </div>
                    </div>

                    <div class="lt-video-grid">
                        @foreach($listingVideos as $video)
                            <div class="lt-video-card">
                                <video class="lt-video-player" controls preload="metadata" src="{{ $video->playableUrl() }}"></video>
                                <p class="lt-video-title">{{ $video->titleLabel() }}</p>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>

        <aside class="lt-side-rail">
            <section class="lt-card lt-side-card">
                <div class="lt-seller-head">
                    <div class="lt-avatar">{{ $sellerInitial !== '' ? $sellerInitial : 'S' }}</div>
                    <div>
                        <p class="lt-seller-kicker">Seller</p>
                        <p class="lt-seller-name">{{ $sellerName }}</p>
                        <div class="lt-seller-meta">{{ $sellerMemberText }}</div>
                    </div>
                </div>

                @if(filled($listing->contact_phone) || filled($listing->contact_email))
                    <div class="lt-contact-panel">
                        @if(filled($listing->contact_phone))
                            <a href="tel:{{ preg_replace('/\s+/', '', (string) $listing->contact_phone) }}" class="lt-contact-primary">
                                {{ $listing->contact_phone }}
                            </a>
                        @endif

                        @if(filled($listing->contact_email))
                            <a href="mailto:{{ $listing->contact_email }}" class="lt-contact-secondary">
                                {{ $listing->contact_email }}
                            </a>
                        @endif
                    </div>
                @endif

                <div class="lt-actions">
                    <div class="lt-row-2">
                        @if(! $listing->user)
                            <button type="button" class="lt-btn" disabled>Unavailable</button>
                        @elseif($canContactSeller)
                            @if($existingConversationId)
                                <a href="{{ route('panel.inbox.index', ['conversation' => $existingConversationId]) }}" class="lt-btn">
                                    Message
                                </a>
                            @else
                                <form method="POST" action="{{ route('conversations.start', $listing) }}" class="lt-action-form">
                                    @csrf
                                    <button type="submit" class="lt-btn">Message</button>
                                </form>
                            @endif
                        @elseif($isOwnListing)
                            <button type="button" class="lt-btn" disabled>Your listing</button>
                        @else
                            <a href="{{ route('login') }}" class="lt-btn">Message</a>
                        @endif

                        @if($primaryContactHref)
                            <a href="{{ $primaryContactHref }}" class="lt-btn lt-btn-outline">{{ $primaryContactLabel }}</a>
                        @else
                            <button type="button" class="lt-btn lt-btn-outline" disabled>No contact</button>
                        @endif
                    </div>

                    @if(! $listing->user)
                        <button type="button" class="lt-btn lt-btn-main" disabled>Unavailable</button>
                    @elseif($canContactSeller)
                        @if($existingConversationId)
                            <a href="{{ route('panel.inbox.index', ['conversation' => $existingConversationId]) }}" class="lt-btn lt-btn-main">
                                Make offer
                            </a>
                        @else
                            <form method="POST" action="{{ route('conversations.start', $listing) }}" class="lt-action-form">
                                @csrf
                                <button type="submit" class="lt-btn lt-btn-main">Make offer</button>
                            </form>
                        @endif
                    @elseif($isOwnListing)
                        <button type="button" class="lt-btn lt-btn-main" disabled>Manage listing</button>
                    @else
                        <a href="{{ route('login') }}" class="lt-btn lt-btn-main">Make offer</a>
                    @endif

                    <div class="lt-row-2">
                        @if($mapUrl)
                            <a href="{{ $mapUrl }}" target="_blank" rel="noreferrer" class="lt-btn lt-btn-outline">
                                View map
                            </a>
                        @else
                            <button type="button" class="lt-btn lt-btn-outline" disabled>View map</button>
                        @endif

                        @if($listing->user && ! $isOwnListing)
                            @auth
                                <form method="POST" action="{{ route('favorites.sellers.toggle', $listing->user) }}" class="lt-action-form">
                                    @csrf
                                    <button type="submit" class="lt-btn lt-btn-outline">
                                        {{ $isSellerFavorited ? 'Saved seller' : 'Save seller' }}
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="lt-btn lt-btn-outline">Save seller</a>
                            @endauth
                        @else
                            <button type="button" class="lt-btn lt-btn-outline" disabled>{{ $isOwnListing ? 'Your account' : 'Save seller' }}</button>
                        @endif
                    </div>
                </div>
            </section>

            <section class="lt-card lt-safety-card">
                <h3 class="lt-safety-title">Safety tips</h3>
                <p class="lt-safety-copy">Inspect the item in person, avoid sending money in advance, and confirm the seller identity before closing the deal.</p>
                <a href="{{ $reportUrl }}" class="lt-inline-link">Report this listing</a>
            </section>
        </aside>
    </div>

    <div class="lt-mobile-actions">
        <div class="lt-mobile-actions-shell">
            <div class="lt-mobile-actions-row">
                @if(! $listing->user)
                    <button type="button" class="lt-btn" disabled>Unavailable</button>
                @elseif($canContactSeller)
                    @if($existingConversationId)
                        <a href="{{ route('panel.inbox.index', ['conversation' => $existingConversationId]) }}" class="lt-btn">
                            Message
                        </a>
                    @else
                        <form method="POST" action="{{ route('conversations.start', $listing) }}" class="lt-action-form">
                            @csrf
                            <button type="submit" class="lt-btn">Message</button>
                        </form>
                    @endif
                @elseif($isOwnListing)
                    <button type="button" class="lt-btn" disabled>Your listing</button>
                @else
                    <a href="{{ route('login') }}" class="lt-btn">Message</a>
                @endif

                @if($primaryContactHref)
                    <a href="{{ $primaryContactHref }}" class="lt-btn lt-btn-outline">{{ $primaryContactLabel }}</a>
                @else
                    <button type="button" class="lt-btn lt-btn-outline" disabled>No contact</button>
                @endif
            </div>

            @if(! $listing->user)
                <button type="button" class="lt-btn lt-btn-main" disabled>Unavailable</button>
            @elseif($canContactSeller)
                @if($existingConversationId)
                    <a href="{{ route('panel.inbox.index', ['conversation' => $existingConversationId]) }}" class="lt-btn lt-btn-main">
                        Make offer
                    </a>
                @else
                    <form method="POST" action="{{ route('conversations.start', $listing) }}" class="lt-action-form">
                        @csrf
                        <button type="submit" class="lt-btn lt-btn-main">Make offer</button>
                    </form>
                @endif
            @elseif($isOwnListing)
                <button type="button" class="lt-btn lt-btn-main" disabled>Manage listing</button>
            @else
                <a href="{{ route('login') }}" class="lt-btn lt-btn-main">Make offer</a>
            @endif
        </div>
    </div>

    @if(($relatedListings ?? collect())->isNotEmpty() || ($themePillCategories ?? collect())->isNotEmpty())
        <section class="lt-related">
            @if(($relatedListings ?? collect())->isNotEmpty())
                <div class="lt-related-head">
                    <div>
                        <h3 class="lt-related-title">Similar listings</h3>
                        <p class="lt-related-copy">More listings with a similar category and visual profile.</p>
                    </div>
                </div>

                <div class="lt-scroll-wrap" data-theme-scroll>
                    <button type="button" class="lt-scroll-btn prev" data-theme-scroll-prev aria-label="Previous listings">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="m15 18-6-6 6-6"/>
                        </svg>
                    </button>

                    <div class="lt-scroll-track" data-theme-scroll-track>
                        @foreach(($relatedListings ?? collect()) as $related)
                            @php
                                $relatedImage = $related->getFirstMediaUrl('listing-images');
                                if (! $relatedImage && is_array($related->images ?? null)) {
                                    $relatedImage = collect($related->images)->first();
                                }

                                $relatedPrice = 'Price on request';
                                if (! is_null($related->price)) {
                                    $relatedPriceValue = (float) $related->price;
                                    $relatedFormattedPrice = number_format($relatedPriceValue, 2, '.', ',');
                                    $relatedFormattedPrice = rtrim(rtrim($relatedFormattedPrice, '0'), '.');
                                    $relatedPrice = $relatedPriceValue > 0
                                        ? $relatedFormattedPrice.' '.($related->currency ?: 'TRY')
                                        : 'Free';
                                }
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

                    <button type="button" class="lt-scroll-btn next" data-theme-scroll-next aria-label="Next listings">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="m9 18 6-6-6-6"/>
                        </svg>
                    </button>
                </div>
            @endif

            @if(($themePillCategories ?? collect())->isNotEmpty())
                <div class="lt-pill-wrap">
                    <h4 class="lt-pill-title">Explore categories</h4>
                    <div class="lt-pills">
                        @foreach(($themePillCategories ?? collect()) as $pillCategory)
                            <a href="{{ route('listings.index', ['category' => $pillCategory->id]) }}" class="lt-pill">{{ $pillCategory->name }}</a>
                        @endforeach
                    </div>
                </div>
            @endif
        </section>
    @endif
</div>

<script>
    (() => {
        document.querySelectorAll('[data-gallery]').forEach((galleryRoot) => {
            const mainImage = galleryRoot.querySelector('[data-gallery-main]');
            const thumbButtons = Array.from(galleryRoot.querySelectorAll('[data-gallery-thumb]'));
            const prevButton = galleryRoot.querySelector('[data-gallery-prev]');
            const nextButton = galleryRoot.querySelector('[data-gallery-next]');
            const currentCounter = galleryRoot.querySelector('[data-gallery-current]');

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

                if (currentCounter) {
                    currentCounter.textContent = String(activeIndex + 1);
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

        document.querySelectorAll('[data-listing-share]').forEach((button) => {
            button.addEventListener('click', async () => {
                const url = button.dataset.shareUrl || window.location.href;
                const title = button.dataset.shareTitle || document.title;

                if (navigator.share) {
                    try {
                        await navigator.share({ title, url });
                        return;
                    } catch (error) {
                        if (error?.name === 'AbortError') {
                            return;
                        }
                    }
                }

                try {
                    await navigator.clipboard.writeText(url);
                    button.classList.add('is-active');
                    window.setTimeout(() => button.classList.remove('is-active'), 1200);
                } catch (error) {
                    window.prompt('Copy this link', url);
                }
            });
        });

        document.querySelectorAll('[data-detail-tabs]').forEach((tabsRoot) => {
            const buttons = Array.from(tabsRoot.querySelectorAll('[data-detail-tab-button]'));
            const panels = Array.from(tabsRoot.querySelectorAll('[data-detail-tab-panel]'));

            const activate = (target) => {
                buttons.forEach((button) => {
                    const active = button.dataset.tab === target;
                    button.classList.toggle('is-active', active);
                    button.setAttribute('aria-selected', active ? 'true' : 'false');
                });

                panels.forEach((panel) => {
                    panel.classList.toggle('is-active', panel.dataset.panel === target);
                });
            };

            buttons.forEach((button) => {
                button.addEventListener('click', () => activate(button.dataset.tab || 'details'));
            });
        });
    })();
</script>
@endsection
