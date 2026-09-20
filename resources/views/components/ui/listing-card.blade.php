@props(['listing', 'favorited' => false, 'featuredIds' => []])

@php
    $listingId = (int) $listing->getKey();
    $image = $listing->primaryImageUrl('card');
    $isFeatured = (bool) $listing->getAttribute('is_featured') || in_array($listingId, $featuredIds, true);
    $city = trim((string) $listing->getAttribute('city'));
    $country = trim((string) $listing->getAttribute('country'));
    $place = $city !== '' ? $city : $country;
    $createdAt = $listing->getAttribute('created_at');
@endphp

<article class="listing-card">
    <div class="listing-card__media">
        <a href="{{ route('listings.show', $listing) }}" aria-label="{{ $listing->getAttribute('title') }}">
            @if($image)
                <img src="{{ $image }}" alt="{{ $listing->getAttribute('title') }}" loading="lazy" decoding="async">
            @else
                <span class="listing-card__placeholder"><x-ui.icon name="image"/></span>
            @endif
        </a>

        <div class="listing-card__flags">
            @if($isFeatured)
                <span class="badge badge--solid">{{ __('promotion::messages.featured_badge') }}</span>
            @endif
            @if($listing->statusValue() === 'sold')
                <span class="badge badge--critical">{{ $listing->statusLabel() }}</span>
            @endif
        </div>

        @auth
            <button
                type="button"
                class="listing-card__favorite {{ $favorited ? 'is-active' : '' }}"
                data-favorite-toggle="{{ route('favorites.listings.toggle', $listing) }}"
                aria-pressed="{{ $favorited ? 'true' : 'false' }}"
                aria-label="{{ __('site::messages.favorites') }}"
            ><x-ui.icon name="heart"/></button>
        @else
            <a
                href="{{ route('login') }}"
                class="listing-card__favorite"
                aria-label="{{ __('site::messages.favorites') }}"
            ><x-ui.icon name="heart"/></a>
        @endauth
    </div>

    <div class="listing-card__body">
        <p class="listing-card__price">{{ $listing->panelPriceLabel() }}</p>
        <h3 class="listing-card__title text-clamp-2">
            <a href="{{ route('listings.show', $listing) }}">{{ $listing->getAttribute('title') }}</a>
        </h3>
        <div class="listing-card__meta">
            @if($place !== '')
                <span>{{ $place }}</span>
                <span aria-hidden="true">·</span>
            @endif
            @if($createdAt)
                <time datetime="{{ $createdAt->toIso8601String() }}">{{ $createdAt->diffForHumans(short: true) }}</time>
            @endif
        </div>
    </div>
</article>
