@extends('panel::layouts.panel', ['panelSection' => 'promotions'])

@section('title', __('promotion::messages.my_promotions'))

@php
    $listingOptions = auth()->user()->panelListingOptions();
    $statusTones = ['active' => 'badge--positive', 'expired' => '', 'cancelled' => 'badge--critical'];
@endphp

@section('panel_content')
<header class="panel-head">
    <div class="panel-head__text">
        <h1 class="title-page">{{ __('promotion::messages.my_promotions') }}</h1>
        <p class="text-muted">{{ $activeCount }} {{ __('promotion::messages.active_promotions') }}</p>
    </div>
    <a href="{{ route('promotions.plans') }}" class="button button--ghost">{{ __('promotion::messages.plans') }}</a>
</header>

<section class="card">
    <div class="card__head">
        <h2 class="card__title">{{ __('promotion::messages.promote') }}</h2>
    </div>
    <form method="POST" action="{{ route('panel.promotions.store') }}" class="card__body">
        @csrf
        <div class="field__row field__row--two">
            <div class="field">
                <label class="field__label" for="promotion-listing">{{ __('promotion::messages.select_listing') }}</label>
                <select id="promotion-listing" name="listing_id" class="select" required>
                    @foreach($listingOptions as $id => $title)
                        <option value="{{ $id }}">{{ $title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="field">
                <label class="field__label" for="promotion-plan">{{ __('promotion::messages.plan') }}</label>
                <select id="promotion-plan" name="plan" class="select" required>
                    @foreach($plans as $plan)
                        <option value="{{ $plan->getAttribute('slug') }}">
                            {{ $plan->getAttribute('name') }} — {{ $plan->priceLabel() }} · {{ $plan->durationLabel() }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="button button--primary" @disabled($listingOptions->isEmpty())>
            {{ __('promotion::messages.activate') }}
        </button>
        @if($listingOptions->isEmpty())
            <p class="field__hint">{{ __('panel::messages.no_listings_hint') }}</p>
        @endif
    </form>
</section>

@if($orders->isNotEmpty())
    <section class="card">
        <div class="data-list">
            @foreach($orders as $order)
                @php $listing = $listings[$order->listingId()] ?? null; @endphp
                <article class="data-row">
                    <div class="data-row__media">
                        @if($listing && $listing['image'])
                            <img src="{{ $listing['image'] }}" alt="" loading="lazy">
                        @else
                            <span class="listing-card__placeholder"><x-ui.icon name="sparkle"/></span>
                        @endif
                    </div>

                    <div class="data-row__main">
                        <p class="data-row__title text-clamp-1">
                            @if($listing)
                                <a href="{{ route('listings.show', $listing['slug']) }}">{{ $listing['title'] }}</a>
                            @else
                                #{{ $order->listingId() }}
                            @endif
                        </p>
                        <div class="data-row__meta">
                            <span class="badge badge--accent">{{ $order->getAttribute('plan_name') }}</span>
                            <span class="badge {{ $statusTones[$order->getAttribute('status')] ?? '' }}">
                                {{ __('promotion::messages.status_'.$order->getAttribute('status')) }}
                            </span>
                            <span>{{ $order->amountLabel() }}</span>
                            @if($order->isRunning())
                                <span class="data-row__metric">
                                    <x-ui.icon name="clock"/>
                                    {{ trans_choice('promotion::messages.days_left', $order->remainingDays(), ['count' => $order->remainingDays()]) }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="data-row__actions">
                        <span class="text-meta">
                            {{ $order->getAttribute('starts_at')?->isoFormat('ll') }} — {{ $order->getAttribute('ends_at')?->isoFormat('ll') }}
                        </span>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    {{ $orders->links('components.pagination') }}
@else
    <x-ui.empty-state icon="sparkle" :title="__('promotion::messages.no_promotions')" :text="__('promotion::messages.no_promotions_hint')">
        <a href="{{ route('promotions.plans') }}" class="button button--secondary">{{ __('promotion::messages.plans') }}</a>
    </x-ui.empty-state>
@endif
@endsection
