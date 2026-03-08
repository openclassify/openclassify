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
        ->filter(fn ($value) => is_array($value) && is_array($value['gallery'] ?? null))
        ->values()
        ->all();
    $initialGalleryImage = $galleryImages[0]['gallery'] ?? null;
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
    $canStartConversation = auth()->check() && $listing->user && ! $isOwnListing;
    $loginRedirectRoute = route('login', ['redirect' => request()->fullUrl()]);
    $chatConversation = $detailConversation ?? null;
    $chatMessages = $chatConversation?->messages ?? collect();
    $chatSendUrl = $chatConversation ? route('conversations.messages.send', $chatConversation) : '';
    $chatReadUrl = $chatConversation ? route('conversations.read', $chatConversation) : '';
    $chatStartUrl = route('conversations.start', $listing);
    $chatUnreadCount = max(0, (int) ($chatConversation?->unread_count ?? 0));

    $primaryContactHref = null;
    $primaryContactLabel = 'Call';
    if (filled($listing->contact_phone)) {
        $primaryContactHref = 'tel:'.preg_replace('/\s+/', '', (string) $listing->contact_phone);
        $primaryContactLabel = 'Call';
    } elseif (filled($listing->contact_email)) {
        $primaryContactHref = 'mailto:'.$listing->contact_email;
        $primaryContactLabel = 'Email';
    }

    $reportEmail = config('mail.from.address', 'support@example.com');
    $reportUrl = 'mailto:'.$reportEmail.'?subject='.rawurlencode('Report listing '.$referenceCode);
    $shareUrl = route('listings.show', $listing);

    $detailRows = collect([
        ['label' => 'Listing ID', 'value' => $referenceCode],
        ['label' => 'Published', 'value' => $publishedAt],
        ['label' => 'Category', 'value' => $listing->category?->name ?? 'General'],
        ['label' => 'Location', 'value' => $locationLabel !== '' ? $locationLabel : 'Not specified'],
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
    $summaryRows = $detailRows->take(8);
    $sellerListingsUrl = $listing->user ? route('listings.index', ['user' => $listing->user->getKey()]) : route('listings.index');
    $locationText = $locationLabel !== '' ? $locationLabel : 'Location not specified';
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

    <section class="lt-card ld-header-card">
        <div class="ld-header-copy">
            <p class="ld-header-ref">{{ $referenceCode }}</p>
            <h1 class="ld-header-title">{{ $displayTitle }}</h1>
            <div class="ld-header-meta">
                <span>{{ $listing->category?->name ?? 'Marketplace listing' }}</span>
                <span>{{ $sellerName }}</span>
                <span>{{ $postedAgo }}</span>
            </div>
        </div>

        <div class="ld-header-side">
            <div class="ld-header-actions" aria-label="Listing actions">
                <button
                    type="button"
                    class="ld-header-action"
                    data-listing-share
                    data-share-url="{{ $shareUrl }}"
                    data-share-title="{{ $displayTitle }}"
                >
                    Share
                </button>

                @auth
                    <form method="POST" action="{{ route('favorites.listings.toggle', $listing) }}" class="ld-inline-form">
                        @csrf
                        <button type="submit" class="ld-header-action {{ $isListingFavorited ? 'is-active' : '' }}">
                            {{ $isListingFavorited ? 'Saved' : 'Save listing' }}
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="ld-header-action">Save listing</a>
                @endauth

                <button type="button" class="ld-header-action" onclick="window.print()">
                    Print
                </button>
            </div>
        </div>
    </section>

    <div class="ld-stage">
        <section class="lt-card ld-gallery-card" data-gallery>
            <div class="lt-gallery-main">
                <div class="lt-gallery-top">
                    <div class="ld-gallery-chip">Photo gallery</div>
                </div>

                @if($initialGalleryImage)
                    <picture data-gallery-picture>
                        <source
                            data-gallery-source-mobile
                            media="(max-width: 767px)"
                            srcset="{{ $initialGalleryImage['mobile'] ?? ($initialGalleryImage['fallback'] ?? '') }}"
                        >
                        <source
                            data-gallery-source-desktop
                            media="(min-width: 768px)"
                            srcset="{{ $initialGalleryImage['desktop'] ?? ($initialGalleryImage['fallback'] ?? '') }}"
                        >
                        <img
                            src="{{ $initialGalleryImage['fallback'] ?? ($initialGalleryImage['desktop'] ?? ($initialGalleryImage['mobile'] ?? '')) }}"
                            alt="{{ $displayTitle }}"
                            data-gallery-main
                        >
                    </picture>
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
                        @php
                            $galleryImage = $image['gallery'] ?? null;
                            $thumbImage = $image['thumb'] ?? $galleryImage;
                        @endphp
                        <button
                            type="button"
                            class="lt-thumb {{ $index === 0 ? 'is-active' : '' }}"
                            data-gallery-thumb
                            data-gallery-index="{{ $index }}"
                            data-gallery-mobile-src="{{ $galleryImage['mobile'] ?? ($galleryImage['fallback'] ?? '') }}"
                            data-gallery-desktop-src="{{ $galleryImage['desktop'] ?? ($galleryImage['fallback'] ?? '') }}"
                            data-gallery-fallback-src="{{ $galleryImage['fallback'] ?? '' }}"
                            aria-label="Open photo {{ $index + 1 }}"
                        >
                            @include('listing::partials.responsive-image', [
                                'image' => $thumbImage,
                                'alt' => $displayTitle.' '.($index + 1),
                                'class' => 'w-full h-full object-cover',
                            ])
                        </button>
                    @endforeach
                </div>
            @endif
        </section>

        <section class="lt-card ld-summary-card">
            <div class="ld-summary-head">
                <div class="ld-summary-price">{{ $priceLabel }}</div>
                <div class="ld-summary-date">{{ $publishedAt }}</div>
            </div>

            <div class="ld-summary-location">{{ $locationText }}</div>

            <div class="lt-spec-table">
                @foreach($summaryRows as $row)
                    <div class="lt-spec-row">
                        <span>{{ $row['label'] }}</span>
                        <strong>{{ $row['value'] }}</strong>
                    </div>
                @endforeach
            </div>

            <a href="{{ $reportUrl }}" class="lt-inline-link">Report this listing</a>
        </section>

        <aside class="lt-card ld-seller-card">
            <div class="lt-seller-head">
                <div class="lt-avatar">{{ $sellerInitial !== '' ? $sellerInitial : 'S' }}</div>
                <div>
                    <p class="lt-seller-kicker">Seller</p>
                    <p class="lt-seller-name">{{ $sellerName }}</p>
                    <div class="lt-seller-meta">{{ $sellerMemberText }}</div>
                </div>
            </div>

            @if($listing->user)
                <div class="ld-seller-links">
                    <a href="{{ $sellerListingsUrl }}" class="ld-seller-link">All listings</a>
                    @if($listing->user && ! $isOwnListing)
                        @auth
                            <form method="POST" action="{{ route('favorites.sellers.toggle', $listing->user) }}" class="ld-inline-form">
                                @csrf
                                <input type="hidden" name="redirect_to" value="{{ request()->fullUrl() }}">
                                <button type="submit" class="ld-seller-link">
                                    {{ $isSellerFavorited ? 'Saved seller' : 'Save seller' }}
                                </button>
                            </form>
                        @else
                            <a href="{{ $loginRedirectRoute }}" class="ld-seller-link">Save seller</a>
                        @endauth
                    @endif
                </div>
            @endif

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
            @else
                <div class="ld-empty-contact">No contact details provided.</div>
            @endif

            <div class="lt-actions">
                <div class="lt-row-2">
                    @if(! $listing->user)
                        <button type="button" class="lt-btn" disabled>Unavailable</button>
                    @elseif($canStartConversation)
                        <button type="button" class="lt-btn" data-inline-chat-trigger>Message</button>
                    @elseif($isOwnListing)
                        <button type="button" class="lt-btn" disabled>Your listing</button>
                    @else
                        <a href="{{ $loginRedirectRoute }}" class="lt-btn">Message</a>
                    @endif

                    @if($primaryContactHref)
                        <a href="{{ $primaryContactHref }}" class="lt-btn lt-btn-outline">{{ $primaryContactLabel }}</a>
                    @else
                        <button type="button" class="lt-btn lt-btn-outline" disabled>No contact</button>
                    @endif
                </div>

                @if($listing->user && ! $isOwnListing)
                    <a href="{{ $sellerListingsUrl }}" class="lt-btn lt-btn-outline">View listings</a>
                @elseif($isOwnListing)
                    <button type="button" class="lt-btn lt-btn-outline" disabled>Your account</button>
                @endif
            </div>
        </aside>
    </div>

    <section class="lt-card ld-tab-card" data-detail-tabs>
        <div class="lt-tab-list" role="tablist" aria-label="Listing sections">
            <button type="button" class="lt-tab-button is-active" data-detail-tab-button data-tab="details" role="tab" aria-selected="true">
                Listing details
            </button>
            <button type="button" class="lt-tab-button" data-detail-tab-button data-tab="description" role="tab" aria-selected="false">
                Description
            </button>
        </div>

        <div class="lt-tab-panel is-active" data-detail-tab-panel data-panel="details" role="tabpanel">
            <div class="lt-spec-table">
                @foreach($detailRows as $row)
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

    <div class="lt-mobile-actions">
        <div class="lt-mobile-actions-shell">
            <div class="lt-mobile-actions-row">
                @if(! $listing->user)
                    <button type="button" class="lt-btn" disabled>Unavailable</button>
                @elseif($canStartConversation)
                    <button type="button" class="lt-btn" data-inline-chat-trigger>Message</button>
                @elseif($isOwnListing)
                    <button type="button" class="lt-btn" disabled>Your listing</button>
                @else
                    <a href="{{ $loginRedirectRoute }}" class="lt-btn">Message</a>
                @endif

                @if($primaryContactHref)
                    <a href="{{ $primaryContactHref }}" class="lt-btn lt-btn-outline">{{ $primaryContactLabel }}</a>
                @else
                    <button type="button" class="lt-btn lt-btn-outline" disabled>No contact</button>
                @endif
            </div>
        </div>
    </div>

    @if($canStartConversation)
        <div
            class="lt-chat-widget is-collapsed"
            data-inline-chat
            data-state="collapsed"
            data-conversation-id="{{ $chatConversation?->id ?? '' }}"
            data-start-url="{{ $chatStartUrl }}"
            data-send-url="{{ $chatSendUrl }}"
            data-read-url="{{ $chatReadUrl }}"
            data-read-url-template="{{ route('conversations.read', ['conversation' => '__CONVERSATION__']) }}"
        >
            <button type="button" class="lt-chat-launcher" data-inline-chat-launcher aria-label="Open chat">
                <span class="lt-chat-launcher-copy">
                    <span class="lt-chat-launcher-kicker">Chat</span>
                    <span class="lt-chat-launcher-name">{{ $sellerName }}</span>
                </span>
                <span class="lt-chat-launcher-badge {{ $chatUnreadCount > 0 ? '' : 'hidden' }}" data-inline-chat-badge>{{ $chatUnreadCount }}</span>
            </button>
            <section class="lt-chat-panel" data-inline-chat-panel hidden>
                <div class="lt-chat-head">
                    <div>
                        <p class="lt-chat-kicker">Chat</p>
                        <p class="lt-chat-name">{{ $sellerName }}</p>
                        <p class="lt-chat-meta">{{ $displayTitle }}</p>
                    </div>
                    <button type="button" class="lt-chat-close" data-inline-chat-close aria-label="Close chat">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9">
                            <path d="M6 6 18 18M18 6 6 18"/>
                        </svg>
                    </button>
                </div>

                <div class="lt-chat-thread" data-inline-chat-thread>
                    @foreach($chatMessages as $message)
                        <div class="lt-chat-item {{ (int) $message->sender_id === (int) auth()->id() ? 'is-mine' : '' }}" data-message-id="{{ $message->id }}">
                            <div class="lt-chat-bubble">{{ $message->body }}</div>
                            <span class="lt-chat-time">{{ $message->created_at?->format('H:i') }}</span>
                        </div>
                    @endforeach

                    <div class="lt-chat-empty {{ $chatMessages->isNotEmpty() ? 'is-hidden' : '' }}" data-inline-chat-empty>
                        Send the first message without leaving this page.
                    </div>
                </div>

                <form class="lt-chat-form" data-inline-chat-form>
                    <input
                        type="text"
                        name="message"
                        class="lt-chat-input"
                        data-inline-chat-input
                        maxlength="2000"
                        placeholder="Write a message"
                        autocomplete="off"
                        required
                    >
                    <button type="submit" class="lt-chat-send" data-inline-chat-submit aria-label="Send message">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h13m0 0-5-5m5 5-5 5"/>
                        </svg>
                    </button>
                </form>

                <p class="lt-chat-error is-hidden" data-inline-chat-error></p>
            </section>
        </div>
    @endif

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
                                $relatedImage = $related->primaryImageData('card');
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
                                        @include('listing::partials.responsive-image', [
                                            'image' => $relatedImage,
                                            'alt' => $related->title,
                                            'class' => 'w-full h-full object-cover',
                                        ])
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
            const mainMobileSource = galleryRoot.querySelector('[data-gallery-source-mobile]');
            const mainDesktopSource = galleryRoot.querySelector('[data-gallery-source-desktop]');
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
                const mobileSrc = thumbButtons[index].dataset.galleryMobileSrc || '';
                const desktopSrc = thumbButtons[index].dataset.galleryDesktopSrc || '';
                const fallbackSrc = thumbButtons[index].dataset.galleryFallbackSrc || desktopSrc || mobileSrc;

                if (mainMobileSource && mobileSrc) {
                    mainMobileSource.srcset = mobileSrc;
                }

                if (mainDesktopSource && desktopSrc) {
                    mainDesktopSource.srcset = desktopSrc;
                }

                if (fallbackSrc) {
                    mainImage.src = fallbackSrc;
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
