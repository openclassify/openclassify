@extends('panel::layouts.panel', ['panelSection' => 'notifications'])

@section('title', __('notification::messages.notifications'))

@section('panel_content')
<header class="panel-head">
    <div class="panel-head__text">
        <h1 class="title-page">{{ __('notification::messages.notifications') }}</h1>
        <p class="text-muted">{{ $unreadCount }} {{ __('notification::messages.unread') }}</p>
    </div>
    @if($unreadCount > 0)
        <form method="POST" action="{{ route('panel.notifications.read-all') }}">
            @csrf
            <button type="submit" class="button button--secondary">{{ __('notification::messages.mark_all_read') }}</button>
        </form>
    @endif
</header>

@if($notifications->isNotEmpty())
    <section class="card">
        <div class="data-list">
            @foreach($notifications as $notification)
                <article class="data-row" style="grid-template-columns: auto minmax(0,1fr) auto">
                    <span class="avatar avatar--small" @style(['background: var(--accent-soft); color: var(--accent-strong)' => $notification->isUnread()])>
                        <x-ui.icon :name="$notification->iconName()" style="width:14px;height:14px"/>
                    </span>

                    <div class="data-row__main">
                        <p class="data-row__title">
                            {{ $notification->getAttribute('title') }}
                            @if($notification->isUnread())
                                <span class="badge badge--accent">{{ __('notification::messages.unread') }}</span>
                            @endif
                        </p>
                        @if(filled($notification->getAttribute('body')))
                            <p class="text-muted">{{ $notification->getAttribute('body') }}</p>
                        @endif
                        <div class="data-row__meta">
                            <time datetime="{{ $notification->getAttribute('created_at')?->toIso8601String() }}">
                                {{ $notification->getAttribute('created_at')?->diffForHumans() }}
                            </time>
                        </div>
                    </div>

                    <div class="data-row__actions">
                        <form method="POST" action="{{ route('panel.notifications.read', $notification) }}">
                            @csrf
                            <button type="submit" class="button button--secondary button--small">{{ __('notification::messages.view') }}</button>
                        </form>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    {{ $notifications->links('components.pagination') }}
@else
    <x-ui.empty-state icon="bell" :title="__('notification::messages.empty')" :text="__('notification::messages.empty_hint')"/>
@endif
@endsection
