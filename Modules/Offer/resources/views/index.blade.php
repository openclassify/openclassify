@extends('panel::layouts.panel', ['panelSection' => 'offers'])

@section('title', __('offer::messages.offers'))

@php
    $statusTabs = [
        'all' => __('offer::messages.all'),
        'pending' => __('offer::messages.status_pending'),
        'accepted' => __('offer::messages.status_accepted'),
        'declined' => __('offer::messages.status_declined'),
    ];
    $tones = ['positive' => 'badge--positive', 'critical' => 'badge--critical', 'caution' => 'badge--caution', 'default' => ''];
@endphp

@section('panel_content')
<header class="panel-head">
    <div class="panel-head__text">
        <h1 class="title-page">{{ __('offer::messages.offers') }}</h1>
        <p class="text-muted">{{ trans_choice('site::messages.results_count', $offers->total(), ['count' => $offers->total()]) }}</p>
    </div>
</header>

<nav class="chip-row">
    <a href="{{ route('panel.offers.index', ['direction' => 'received']) }}" class="pill {{ $direction === 'received' ? 'is-active' : '' }}">{{ __('offer::messages.received') }}</a>
    <a href="{{ route('panel.offers.index', ['direction' => 'sent']) }}" class="pill {{ $direction === 'sent' ? 'is-active' : '' }}">{{ __('offer::messages.sent_tab') }}</a>
</nav>

@if($direction === 'received')
    <nav class="chip-row">
        @foreach($statusTabs as $key => $label)
            <a href="{{ route('panel.offers.index', ['direction' => 'received', 'status' => $key]) }}"
               class="pill {{ $status === $key ? 'is-active' : '' }}">
                {{ $label }}
                <span>{{ $counts[$key] ?? 0 }}</span>
            </a>
        @endforeach
    </nav>
@endif

@if($offers->isNotEmpty())
    <section class="card">
        <div class="data-list">
            @foreach($offers as $offer)
                @php
                    $listing = $listings[$offer->listingId()] ?? null;
                    $person = $people[$direction === 'sent' ? (int) $offer->getAttribute('seller_id') : $offer->buyerId()] ?? null;
                @endphp
                <article class="data-row">
                    <div class="data-row__media">
                        @if($listing && $listing['image'])
                            <img src="{{ $listing['image'] }}" alt="" loading="lazy">
                        @else
                            <span class="listing-card__placeholder"><x-ui.icon name="image"/></span>
                        @endif
                    </div>

                    <div class="data-row__main">
                        <p class="data-row__title text-clamp-1">
                            @if($listing)
                                <a href="{{ route('listings.show', $listing['slug']) }}">{{ $listing['title'] }}</a>
                            @else
                                #{{ $offer->listingId() }}
                            @endif
                        </p>
                        <div class="data-row__meta">
                            <span class="text-price">{{ $offer->amountLabel() }}</span>
                            @if($listing)
                                <span>{{ __('panel::messages.price') }}: {{ $listing['price'] }}</span>
                            @endif
                            <span class="badge {{ $tones[$offer->statusTone()] }}">{{ __('offer::messages.status_'.$offer->getAttribute('status')) }}</span>
                            @if($person)
                                <span class="data-row__metric"><x-ui.icon name="user"/>{{ $person['name'] }}</span>
                            @endif
                            <time class="data-row__metric" datetime="{{ $offer->getAttribute('created_at')?->toIso8601String() }}">
                                <x-ui.icon name="clock"/>{{ $offer->getAttribute('created_at')?->diffForHumans(short: true) }}
                            </time>
                        </div>
                        @if(filled($offer->getAttribute('message')))
                            <p class="text-muted text-clamp-2">{{ $offer->getAttribute('message') }}</p>
                        @endif
                    </div>

                    <div class="data-row__actions">
                        @if($direction === 'received' && $offer->isPending())
                            <form method="POST" action="{{ route('offers.accept', $offer) }}">
                                @csrf
                                <button type="submit" class="button button--primary button--small">{{ __('offer::messages.accept') }}</button>
                            </form>
                            <form method="POST" action="{{ route('offers.decline', $offer) }}">
                                @csrf
                                <button type="submit" class="button button--ghost button--small">{{ __('offer::messages.decline') }}</button>
                            </form>
                        @elseif($direction === 'sent' && $offer->isPending())
                            <form method="POST" action="{{ route('offers.withdraw', $offer) }}">
                                @csrf
                                <button type="submit" class="button button--ghost button--small">{{ __('offer::messages.withdraw') }}</button>
                            </form>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    {{ $offers->links('components.pagination') }}
@else
    <x-ui.empty-state icon="sort" :title="__('offer::messages.no_offers')" :text="__('offer::messages.no_offers_hint')"/>
@endif
@endsection
