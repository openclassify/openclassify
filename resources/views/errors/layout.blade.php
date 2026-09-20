@extends('site::layouts.app')

@section('title', $title)

@section('content')
<div class="shell shell--narrow page">
    <div class="empty-state" style="border:0;background:transparent">
        <span class="empty-state__icon"><x-ui.icon :name="$icon ?? 'shield'"/></span>
        <p class="text-eyebrow">{{ $code }}</p>
        <h1 class="title-page">{{ $title }}</h1>
        <p class="empty-state__text">{{ $message }}</p>
        <div class="row row--wrap" style="justify-content:center">
            <a href="{{ route('home') }}" class="button button--primary">{{ __('site::messages.home') }}</a>
            <a href="{{ route('listings.index') }}" class="button button--secondary">{{ __('site::messages.browse') }}</a>
        </div>
    </div>
</div>
@endsection
