@extends('panel::layouts.panel', ['panelSection' => 'videos'])

@section('title', __('panel::messages.edit'))

@section('panel_content')
<header class="panel-head">
    <div class="panel-head__text">
        <h1 class="title-page">{{ __('panel::messages.edit') }}</h1>
        <p class="text-muted text-clamp-1">{{ $video->getAttribute('title') }}</p>
    </div>
    <a href="{{ route('panel.videos.index') }}" class="button button--ghost">
        <x-ui.icon name="arrow-left"/>
        <span>{{ __('site::messages.back') }}</span>
    </a>
</header>

<section class="card">
    <form method="POST" action="{{ route('panel.videos.update', $video) }}" class="card__body">
        @csrf
        @method('PUT')

        <div class="field">
            <label class="field__label" for="video-title">{{ __('panel::messages.title') }}</label>
            <input id="video-title" type="text" name="title" value="{{ old('title', $video->getAttribute('title')) }}" class="input" maxlength="120">
            @error('title')<p class="field__error">{{ $message }}</p>@enderror
        </div>

        <label class="checkbox">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $video->getAttribute('is_active')))>
            <span>{{ __('panel::messages.active') }}</span>
        </label>

        <button type="submit" class="button button--primary">{{ __('panel::messages.save') }}</button>
    </form>
</section>
@endsection
