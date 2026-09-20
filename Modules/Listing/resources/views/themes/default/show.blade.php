@extends('site::layouts.app')

@section('title', $listing->getAttribute('title'))
@section('description', \Illuminate\Support\Str::limit(strip_tags((string) $listing->getAttribute('description')), 155))
@section('og_image', $listing->primaryImageUrl('gallery') ?? '')

@php
    $seller = $listing->getRelation('user');
    $viewer = auth()->user();
    $isOwner = $viewer !== null && $sellerId !== null && (int) $viewer->getKey() === $sellerId;
    $city = trim((string) $listing->getAttribute('city'));
    $country = trim((string) $listing->getAttribute('country'));
    $place = collect([$city, $country])->filter()->implode(', ');
    $createdAt = $listing->getAttribute('created_at');
    $canContact = $viewer !== null && ! $isOwner && $sellerId !== null;
@endphp

@section('content')
<div class="shell shell--wide page">
    <div class="stack stack--loose">
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">{{ __('site::messages.home') }}</a>
            <span class="breadcrumb__separator">/</span>
            <a href="{{ route('listings.index') }}">{{ __('site::messages.all_listings') }}</a>
            @foreach($breadcrumbCategories as $crumb)
                <span class="breadcrumb__separator">/</span>
                <a href="{{ route('listings.index', ['category' => $crumb->getKey()]) }}">{{ $crumb->getAttribute('name') }}</a>
            @endforeach
        </nav>

        <div class="grid grid--split">
            <div class="stack stack--loose">
                <section class="gallery" data-gallery>
                    <div class="gallery__stage">
                        @php $first = $gallery[0]['gallery'] ?? null; @endphp
                        <img
                            src="{{ \Modules\Listing\Support\ListingImageViewData::pickUrl($first) ?? '' }}"
                            alt="{{ $listing->getAttribute('title') }}"
                            data-gallery-stage
                            fetchpriority="high"
                        >
                        @if(count($gallery) > 1)
                            <button type="button" class="gallery__nav gallery__nav--previous" data-gallery-previous aria-label="{{ __('site::messages.back') }}">
                                <x-ui.icon name="chevron-left"/>
                            </button>
                            <button type="button" class="gallery__nav gallery__nav--next" data-gallery-next aria-label="{{ __('site::messages.view_all') }}">
                                <x-ui.icon name="chevron-right"/>
                            </button>
                            <span class="gallery__counter" data-gallery-counter>1 / {{ count($gallery) }}</span>
                        @endif
                    </div>

                    @if(count($gallery) > 0)
                        <div class="gallery__thumbs">
                            @foreach($gallery as $index => $image)
                                <button
                                    type="button"
                                    class="gallery__thumb {{ $index === 0 ? 'is-active' : '' }}"
                                    data-gallery-thumb
                                    data-gallery-source="{{ \Modules\Listing\Support\ListingImageViewData::pickUrl($image['gallery'] ?? null) }}"
                                    data-gallery-alt="{{ $listing->getAttribute('title') }}"
                                    aria-label="{{ $index + 1 }}"
                                >
                                    <img src="{{ \Modules\Listing\Support\ListingImageViewData::pickUrl($image['thumb'] ?? null) }}" alt="" loading="lazy">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </section>

                <section class="card">
                    <div class="card__body">
                        <div class="stack stack--tight">
                            <p class="text-price text-price--large">{{ $listing->panelPriceLabel() }}</p>
                            <h1 class="title-page">{{ $listing->getAttribute('title') }}</h1>
                            <div class="row row--wrap text-meta">
                                @if($place !== '')
                                    <span class="row" style="gap:var(--space-1)"><x-ui.icon name="map-pin" style="width:14px;height:14px"/>{{ $place }}</span>
                                @endif
                                @if($createdAt)
                                    <span class="row" style="gap:var(--space-1)"><x-ui.icon name="clock" style="width:14px;height:14px"/><time datetime="{{ $createdAt->toIso8601String() }}">{{ $createdAt->diffForHumans() }}</time></span>
                                @endif
                                <span class="row" style="gap:var(--space-1)"><x-ui.icon name="eye" style="width:14px;height:14px"/>{{ trans_choice('site::messages.views', (int) $listing->getAttribute('view_count'), ['count' => (int) $listing->getAttribute('view_count')]) }}</span>
                            </div>
                        </div>

                        @if(filled($listing->getAttribute('description')))
                            <div class="stack stack--tight">
                                <h2 class="card__title">{{ __('site::messages.description') }}</h2>
                                <div class="prose">{!! nl2br(e($listing->getAttribute('description'))) !!}</div>
                            </div>
                        @endif

                        @if(! empty($presentableCustomFields))
                            <div class="stack stack--tight">
                                <h2 class="card__title">{{ __('site::messages.details') }}</h2>
                                <dl class="spec-list">
                                    @foreach($presentableCustomFields as $field)
                                        <div class="spec-list__row">
                                            <dt class="spec-list__label">{{ $field['label'] }}</dt>
                                            <dd class="spec-list__value">{{ $field['value'] }}</dd>
                                        </div>
                                    @endforeach
                                </dl>
                            </div>
                        @endif

                        <div class="stack stack--tight">
                            <dl class="spec-list">
                                <div class="spec-list__row">
                                    <dt class="spec-list__label">{{ __('site::messages.listing_id') }}</dt>
                                    <dd class="spec-list__value">#{{ $listing->getKey() }}</dd>
                                </div>
                                @if($listing->getRelation('category'))
                                    <div class="spec-list__row">
                                        <dt class="spec-list__label">{{ __('site::messages.category') }}</dt>
                                        <dd class="spec-list__value">{{ $listing->getRelation('category')->getAttribute('name') }}</dd>
                                    </div>
                                @endif
                            </dl>
                        </div>
                    </div>
                </section>

                @if($listingVideos->isNotEmpty())
                    <section class="card">
                        <div class="card__head"><h2 class="card__title">{{ __('site::messages.details') }}</h2></div>
                        <div class="card__body">
                            @foreach($listingVideos as $video)
                                <video controls preload="none" style="width:100%;border-radius:var(--radius-md)">
                                    <source src="{{ $video->playbackUrl() }}">
                                </video>
                            @endforeach
                        </div>
                    </section>
                @endif

                <div class="alert">
                    <x-ui.icon name="shield"/>
                    <span>{{ __('site::messages.safety_note') }}</span>
                </div>
            </div>

            <aside class="sticky-aside">
                <section class="card">
                    <div class="card__body seller-card">
                        @if($seller)
                            <div class="seller-card__identity">
                                <span class="avatar">{{ \App\Support\UserDirectory::initials((string) $seller->getAttribute('name')) }}</span>
                                <div class="stack stack--tight" style="gap:2px">
                                    <a href="{{ route('sellers.show', $sellerId) }}" class="seller-card__name">{{ $seller->getAttribute('name') }}</a>
                                    <x-ui.rating :average="$sellerReviewSummary['average']" :total="$sellerReviewSummary['total']"/>
                                </div>
                            </div>
                        @endif

                        @auth
                            @if($canContact)
                                <div class="stack stack--tight">
                                    <form method="POST" action="{{ route('conversations.start', $listing) }}">
                                        @csrf
                                        <button type="submit" class="button button--primary button--block">
                                            <x-ui.icon name="mail"/>
                                            <span>{{ __('site::messages.send_message') }}</span>
                                        </button>
                                    </form>

                                    @if($listing->hasContactDetails())
                                        <div data-contact-reveal="{{ route('listings.contact', $listing) }}" class="contact-panel">
                                            <button type="button" class="button button--secondary button--block" data-contact-trigger>
                                                <x-ui.icon name="phone"/>
                                                <span>{{ __('site::messages.show_contact') }}</span>
                                            </button>
                                            <div data-contact-output class="contact-panel">
                                                <a class="contact-panel__value" data-contact-phone href="#"><x-ui.icon name="phone"/><span></span></a>
                                                <a class="contact-panel__value" data-contact-email href="#"><x-ui.icon name="mail"/><span></span></a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @elseif($isOwner)
                                <a href="{{ route('panel.listings.edit', $listing) }}" class="button button--secondary button--block">
                                    <x-ui.icon name="edit"/>
                                    <span>{{ __('panel::messages.edit') }}</span>
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="button button--primary button--block">{{ __('site::messages.sign_in_to_message') }}</a>
                        @endauth

                        <div class="row">
                            @auth
                                <button
                                    type="button"
                                    class="button button--secondary {{ $isListingFavorited ? 'is-active' : '' }}"
                                    data-favorite-toggle="{{ route('favorites.listings.toggle', $listing) }}"
                                    aria-pressed="{{ $isListingFavorited ? 'true' : 'false' }}"
                                >
                                    <x-ui.icon name="heart"/>
                                    <span>{{ __('site::messages.save') }}</span>
                                </button>
                            @endauth
                            <button
                                type="button"
                                class="button button--secondary"
                                data-share="{{ route('listings.show', $listing) }}"
                                data-share-title="{{ $listing->getAttribute('title') }}"
                                data-share-label="{{ __('site::messages.share') }}"
                                data-share-done="{{ __('site::messages.copied') }}"
                            >
                                <x-ui.icon name="share"/>
                                <span>{{ __('site::messages.share') }}</span>
                            </button>
                        </div>
                    </div>
                </section>

                @if($canContact && $listing->getAttribute('price') !== null)
                    <section class="card">
                        <div class="card__head">
                            <h2 class="card__title">{{ __('offer::messages.make_offer') }}</h2>
                            @if($bestOffer)
                                <span class="badge badge--accent">{{ __('offer::messages.best_offer') }} {{ $bestOffer->amountLabel() }}</span>
                            @endif
                        </div>
                        <form method="POST" action="{{ route('offers.store', $listing) }}" class="card__body">
                            @csrf
                            <div class="field">
                                <label class="field__label" for="offer-amount">{{ __('offer::messages.your_offer') }}</label>
                                <span class="input-affix">
                                    <input id="offer-amount" type="number" name="amount" min="1" step="0.01" class="input" required
                                           value="{{ round((float) $listing->getAttribute('price') * 0.9, 2) }}">
                                    <span class="input-affix__suffix">{{ $listing->getAttribute('currency') }}</span>
                                </span>
                            </div>
                            <div class="field">
                                <label class="field__label" for="offer-message">{{ __('offer::messages.offer_message') }}</label>
                                <textarea id="offer-message" name="message" class="textarea" rows="3" maxlength="500"></textarea>
                            </div>
                            <button type="submit" class="button button--accent button--block">{{ __('offer::messages.send_offer') }}</button>
                        </form>
                    </section>
                @endif

                @auth
                    @unless($isOwner)
                        <section class="card">
                            <div class="card__body card__body--tight">
                                <button type="button" class="button button--ghost button--block" data-reveal-target="report-panel">
                                    <x-ui.icon name="flag"/>
                                    <span>{{ __('report::messages.report_listing') }}</span>
                                </button>

                                <form method="POST" action="{{ route('reports.store') }}" id="report-panel" class="stack stack--tight" hidden>
                                    @csrf
                                    <input type="hidden" name="subject_type" value="listing">
                                    <input type="hidden" name="subject_id" value="{{ $listing->getKey() }}">
                                    <div class="field">
                                        <label class="field__label" for="report-reason">{{ __('report::messages.reason') }}</label>
                                        <select id="report-reason" name="reason" class="select" required>
                                            @foreach($reportReasons as $reason)
                                                <option value="{{ $reason }}">{{ __('report::messages.reason_'.$reason) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="field">
                                        <label class="field__label" for="report-details">{{ __('report::messages.details') }}</label>
                                        <textarea id="report-details" name="details" class="textarea" rows="3" maxlength="1000" placeholder="{{ __('report::messages.placeholder') }}"></textarea>
                                    </div>
                                    <button type="submit" class="button button--critical button--block">{{ __('report::messages.submit') }}</button>
                                </form>
                            </div>
                        </section>
                    @endunless
                @endauth
            </aside>
        </div>

        @if($relatedListings->isNotEmpty())
            <section class="section">
                <div class="section__head">
                    <h2 class="title-section">{{ __('site::messages.similar_listings') }}</h2>
                </div>
                <div class="grid grid--listings">
                    @foreach($relatedListings->take(10) as $related)
                        <x-ui.listing-card :listing="$related"/>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</div>

@if($canContact)
    <div class="action-bar">
        <form method="POST" action="{{ route('conversations.start', $listing) }}" style="flex:1 1 0">
            @csrf
            <button type="submit" class="button button--primary button--block">{{ __('site::messages.send_message') }}</button>
        </form>
    </div>
@endif
@endsection
