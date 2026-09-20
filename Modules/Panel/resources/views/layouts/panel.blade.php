@extends('site::layouts.app')

@php
    $panelUserId = (int) auth()->id();
    $panelSection = $panelSection ?? '';
    $panelItems = [
        ['key' => 'dashboard', 'label' => __('panel::messages.dashboard'), 'icon' => 'chart', 'url' => route('panel.index'), 'count' => null],
        ['key' => 'listings', 'label' => __('panel::messages.my_listings'), 'icon' => 'tag', 'url' => route('panel.listings.index'), 'count' => \Modules\Listing\Models\Listing::query()->ownedByUser($panelUserId)->count()],
        ['key' => 'offers', 'label' => __('offer::messages.offers'), 'icon' => 'sort', 'url' => route('panel.offers.index'), 'count' => \Modules\Offer\Models\Offer::pendingCountForSeller($panelUserId)],
        ['key' => 'inbox', 'label' => __('panel::messages.inbox'), 'icon' => 'mail', 'url' => route('panel.inbox.index'), 'count' => auth()->user()->unreadInboxCount()],
        ['key' => 'notifications', 'label' => __('notification::messages.notifications'), 'icon' => 'bell', 'url' => route('panel.notifications.index'), 'count' => \Modules\Notification\Models\UserNotification::unreadCountForUser($panelUserId)],
        ['key' => 'promotions', 'label' => __('promotion::messages.promotions'), 'icon' => 'sparkle', 'url' => route('panel.promotions.index'), 'count' => \Modules\Promotion\Models\PromotionOrder::activeCountForUser($panelUserId)],
        ['key' => 'videos', 'label' => __('panel::messages.videos'), 'icon' => 'video', 'url' => route('panel.videos.index'), 'count' => null],
        ['key' => 'favorites', 'label' => __('panel::messages.favorites'), 'icon' => 'heart', 'url' => route('favorites.index'), 'count' => null],
        ['key' => 'profile', 'label' => __('panel::messages.profile'), 'icon' => 'user', 'url' => route('panel.profile.edit'), 'count' => null],
    ];
@endphp

@section('content')
<div class="shell shell--wide">
    <div class="panel-layout">
        <nav class="panel-nav" aria-label="{{ __('panel::messages.dashboard') }}">
            @foreach($panelItems as $item)
                <a href="{{ $item['url'] }}" class="panel-nav__item {{ $panelSection === $item['key'] ? 'is-active' : '' }}">
                    <x-ui.icon :name="$item['icon']"/>
                    <span>{{ $item['label'] }}</span>
                    @if($item['count'])
                        <span class="panel-nav__count">{{ $item['count'] > 99 ? '99+' : $item['count'] }}</span>
                    @endif
                </a>
            @endforeach
        </nav>

        <div class="stack stack--loose">
            @yield('panel_content')
        </div>
    </div>
</div>
@endsection
