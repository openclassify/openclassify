@extends('site::layouts.app')

@section('title', __('site::messages.hero_title'))
@section('description', __('site::messages.hero_lead'))

@section('content')
<section class="hero">
    <div class="shell">
        <div class="hero__inner">
            <h1 class="title-hero hero__title">{{ __('site::messages.hero_title') }}</h1>
            <p class="text-lead hero__lead">{{ __('site::messages.hero_lead') }}</p>

            <form action="{{ route('listings.index') }}" method="GET" class="hero__search" role="search">
                <div class="hero__search-row">
                    <span class="input-affix">
                        <x-ui.icon name="search" class="input-affix__icon"/>
                        <label class="visually-hidden" for="hero-search">{{ __('site::messages.search') }}</label>
                        <input id="hero-search" type="search" name="search" class="input" placeholder="{{ __('site::messages.search_placeholder') }}">
                    </span>
                    <button type="submit" class="button button--primary button--large">{{ __('site::messages.search') }}</button>
                </div>
            </form>

            <div class="hero__stats">
                <span class="hero__stat"><strong>{{ number_format($listingCount) }}</strong> {{ __('site::messages.active_listings') }}</span>
                <span class="hero__stat"><strong>{{ number_format($categoryCount) }}</strong> {{ __('site::messages.categories') }}</span>
                <span class="hero__stat"><strong>{{ number_format($userCount) }}</strong> {{ __('site::messages.members') }}</span>
            </div>
        </div>
    </div>
</section>

<div class="shell shell--wide page">
    <div class="stack stack--section">
        @if($categories->isNotEmpty())
        <section class="section">
            <div class="section__head">
                <h2 class="title-section">{{ __('site::messages.popular_categories') }}</h2>
                <a href="{{ route('categories.index') }}" class="text-link">{{ __('site::messages.explore_all') }}</a>
            </div>

            <div class="grid grid--categories">
                @foreach($categories->take(12) as $category)
                    <a href="{{ route('listings.index', ['category' => $category->getKey()]) }}" class="category-card">
                        <span class="category-card__icon">
                            @if($category->iconUrl())
                                <img src="{{ $category->iconUrl() }}" alt="" loading="lazy">
                            @else
                                <x-ui.icon name="grid"/>
                            @endif
                        </span>
                        <span class="category-card__name">{{ $category->getAttribute('name') }}</span>
                    </a>
                @endforeach
            </div>
        </section>
        @endif

        @if($featuredListings->isNotEmpty())
        <section class="section">
            <div class="section__head">
                <h2 class="title-section">{{ __('site::messages.featured') }}</h2>
                <a href="{{ route('listings.index', ['sort' => 'relevance']) }}" class="text-link">{{ __('site::messages.view_all') }}</a>
            </div>

            <div class="grid grid--listings">
                @foreach($featuredListings as $listing)
                    <x-ui.listing-card :listing="$listing" :favorited="in_array((int) $listing->getKey(), $favoriteListingIds, true)"/>
                @endforeach
            </div>
        </section>
        @endif

        <section class="section">
            <div class="section__head">
                <h2 class="title-section">{{ __('site::messages.recent_listings') }}</h2>
                <a href="{{ route('listings.index', ['sort' => 'newest']) }}" class="text-link">{{ __('site::messages.view_all') }}</a>
            </div>

            @if($recentListings->isNotEmpty())
                <div class="grid grid--listings">
                    @foreach($recentListings as $listing)
                        <x-ui.listing-card :listing="$listing" :favorited="in_array((int) $listing->getKey(), $favoriteListingIds, true)"/>
                    @endforeach
                </div>
            @else
                <x-ui.empty-state icon="tag" :title="__('site::messages.no_listings')" :text="__('site::messages.no_listings_hint')"/>
            @endif
        </section>

        <section class="promo-banner">
            <h2 class="promo-banner__title">{{ __('site::messages.sell_something') }}</h2>
            <p class="promo-banner__text">{{ __('site::messages.hero_lead') }}</p>
            <div class="row row--wrap">
                <a href="{{ auth()->check() ? route('panel.listings.create') : route('register') }}" class="button button--secondary">
                    {{ __('site::messages.post_listing_cta') }}
                </a>
                <a href="{{ route('promotions.plans') }}" class="button button--ghost" style="color:#fff">
                    {{ __('promotion::messages.plans') }}
                </a>
            </div>
        </section>
    </div>
</div>
@endsection
