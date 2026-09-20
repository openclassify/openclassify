@extends('panel::layouts.panel', ['panelSection' => 'videos'])

@section('title', __('panel::messages.videos'))

@section('panel_content')
<header class="panel-head">
    <div class="panel-head__text">
        <h1 class="title-page">{{ __('panel::messages.videos') }}</h1>
        <p class="text-muted">{{ trans_choice('site::messages.results_count', $videos->total(), ['count' => $videos->total()]) }}</p>
    </div>
</header>

<section class="card">
    <div class="card__head"><h2 class="card__title">{{ __('panel::messages.new_listing') }}</h2></div>
    <form method="POST" action="{{ route('panel.videos.store') }}" enctype="multipart/form-data" class="card__body">
        @csrf
        <div class="field__row field__row--two">
            <div class="field">
                <label class="field__label" for="video-listing">{{ __('promotion::messages.select_listing') }}</label>
                <select id="video-listing" name="listing_id" class="select" required>
                    @foreach($listingOptions as $id => $title)
                        <option value="{{ $id }}">{{ $title }}</option>
                    @endforeach
                </select>
                @error('listing_id')<p class="field__error">{{ $message }}</p>@enderror
            </div>
            <div class="field">
                <label class="field__label" for="video-title">{{ __('panel::messages.title') }}</label>
                <input id="video-title" type="text" name="title" class="input" maxlength="120">
                @error('title')<p class="field__error">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="field">
            <label class="field__label" for="video-file">{{ __('panel::messages.videos') }}</label>
            <input id="video-file" type="file" name="video" class="input" accept="video/*" required>
            @error('video')<p class="field__error">{{ $message }}</p>@enderror
        </div>

        <button type="submit" class="button button--primary">{{ __('panel::messages.save') }}</button>
    </form>
</section>

@if($videos->isNotEmpty())
    <section class="card">
        <div class="data-list">
            @foreach($videos as $video)
                <article class="data-row" style="grid-template-columns: auto minmax(0,1fr) auto">
                    <span class="avatar avatar--small"><x-ui.icon name="video" style="width:14px;height:14px"/></span>
                    <div class="data-row__main">
                        <p class="data-row__title text-clamp-1">{{ $video->getAttribute('title') ?: '—' }}</p>
                        <div class="data-row__meta">
                            <span class="badge">{{ $video->getAttribute('status') }}</span>
                            <span>{{ $video->getAttribute('duration_seconds') }}s</span>
                        </div>
                    </div>
                    <div class="data-row__actions">
                        <a href="{{ route('panel.videos.edit', $video) }}" class="button button--secondary button--small">{{ __('panel::messages.edit') }}</a>
                        <form method="POST" action="{{ route('panel.videos.destroy', $video) }}" data-confirm="{{ __('panel::messages.confirm_delete') }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button button--critical button--small">{{ __('panel::messages.delete') }}</button>
                        </form>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    {{ $videos->links('components.pagination') }}
@else
    <x-ui.empty-state icon="video" :title="__('panel::messages.no_listings')" :text="__('panel::messages.no_listings_hint')"/>
@endif
@endsection
