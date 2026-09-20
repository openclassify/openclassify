@extends('panel::layouts.panel', ['panelSection' => 'dashboard'])

@section('title', __('panel::messages.dashboard'))

@section('panel_content')
<header class="panel-head">
    <div class="panel-head__text">
        <h1 class="title-page">{{ __('panel::messages.welcome', ['name' => auth()->user()->getDisplayName()]) }}</h1>
        <p class="text-muted">{{ __('panel::messages.overview') }}</p>
    </div>
    <a href="{{ route('panel.listings.create') }}" class="button button--primary">
        <x-ui.icon name="plus"/>
        <span>{{ __('panel::messages.new_listing') }}</span>
    </a>
</header>

<div class="grid grid--stats">
    <div class="stat-card">
        <span class="stat-card__value">{{ number_format($stats['active']) }}</span>
        <span class="stat-card__label">{{ __('panel::messages.active') }}</span>
    </div>
    <div class="stat-card">
        <span class="stat-card__value">{{ number_format($stats['views']) }}</span>
        <span class="stat-card__label">{{ __('panel::messages.total_views') }}</span>
    </div>
    <div class="stat-card">
        <span class="stat-card__value">{{ number_format($stats['offers']) }}</span>
        <span class="stat-card__label">{{ __('offer::messages.offers') }}</span>
    </div>
    <div class="stat-card">
        <span class="stat-card__value">{{ $stats['reviews']['total'] > 0 ? number_format($stats['reviews']['average'], 1) : '—' }}</span>
        <span class="stat-card__label">{{ __('review::messages.reviews') }}</span>
    </div>
</div>

<div class="grid grid--split">
    <section class="card">
        <div class="card__head">
            <h2 class="card__title">{{ __('panel::messages.my_listings') }}</h2>
            <a href="{{ route('panel.listings.index') }}" class="text-link">{{ __('site::messages.view_all') }}</a>
        </div>

        @if($recentListings->isNotEmpty())
            <div class="data-list">
                @foreach($recentListings as $listing)
                    <div class="data-row">
                        <div class="data-row__media">
                            @if($listing->panelPrimaryImageUrl())
                                <img src="{{ $listing->panelPrimaryImageUrl() }}" alt="" loading="lazy">
                            @endif
                        </div>
                        <div class="data-row__main">
                            <p class="data-row__title text-clamp-1">{{ $listing->getAttribute('title') }}</p>
                            <div class="data-row__meta">
                                <span>{{ $listing->panelPriceLabel() }}</span>
                                <span class="data-row__metric"><x-ui.icon name="eye"/>{{ (int) $listing->getAttribute('view_count') }}</span>
                                <span class="badge">{{ $listing->statusLabel() }}</span>
                            </div>
                        </div>
                        <div class="data-row__actions">
                            <a href="{{ route('panel.listings.edit', $listing) }}" class="button button--secondary button--small">{{ __('panel::messages.edit') }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="card__body">
                <x-ui.empty-state icon="tag" :title="__('panel::messages.no_listings')" :text="__('panel::messages.no_listings_hint')">
                    <a href="{{ route('panel.listings.create') }}" class="button button--primary button--small">{{ __('panel::messages.new_listing') }}</a>
                </x-ui.empty-state>
            </div>
        @endif
    </section>

    <aside class="stack stack--loose">
        <section class="card">
            <div class="card__head">
                <h2 class="card__title">{{ __('notification::messages.notifications') }}</h2>
                <a href="{{ route('panel.notifications.index') }}" class="text-link">{{ __('site::messages.view_all') }}</a>
            </div>
            <div class="card__body card__body--tight">
                @forelse($notifications as $notification)
                    <div class="row row--top" style="gap:var(--space-3)">
                        <span class="avatar avatar--small"><x-ui.icon :name="$notification->iconName()" style="width:14px;height:14px"/></span>
                        <div class="stack" style="gap:2px">
                            <p class="text-body" style="font-weight:var(--weight-medium)">{{ $notification->getAttribute('title') }}</p>
                            <p class="text-meta">{{ $notification->getAttribute('created_at')?->diffForHumans() }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">{{ __('notification::messages.empty') }}</p>
                @endforelse
            </div>
        </section>

        <section class="card">
            <div class="card__head"><h2 class="card__title">{{ __('panel::messages.quick_actions') }}</h2></div>
            <div class="card__body card__body--tight">
                <a href="{{ route('panel.listings.create') }}" class="nav-list__item"><span>{{ __('panel::messages.new_listing') }}</span><x-ui.icon name="chevron-right"/></a>
                <a href="{{ route('panel.promotions.index') }}" class="nav-list__item"><span>{{ __('promotion::messages.promotions') }}</span><x-ui.icon name="chevron-right"/></a>
                <a href="{{ route('panel.offers.index') }}" class="nav-list__item"><span>{{ __('offer::messages.offers') }}</span><x-ui.icon name="chevron-right"/></a>
                <a href="{{ route('sellers.show', auth()->id()) }}" class="nav-list__item"><span>{{ __('site::messages.view_profile') }}</span><x-ui.icon name="chevron-right"/></a>
            </div>
        </section>
    </aside>
</div>
@endsection
