@extends('panel::layouts.panel', ['panelSection' => 'profile'])

@section('title', __('panel::messages.profile'))

@php
    $displayName = trim((string) $user->getAttribute('name'));
    $initials = \App\Support\UserDirectory::initials($displayName !== '' ? $displayName : (string) $user->getAttribute('email'));
@endphp

@section('panel_content')
<header class="panel-head">
    <div class="panel-head__text">
        <h1 class="title-page">{{ __('panel::messages.profile') }}</h1>
        <p class="text-muted">{{ __('user::messages.profile_lead') }}</p>
    </div>
    <a href="{{ route('sellers.show', $user) }}" class="button button--secondary">{{ __('site::messages.view_profile') }}</a>
</header>

<div class="grid grid--split">
    <div class="stack stack--loose">
        <section class="card">
            <div class="card__head"><h2 class="card__title">{{ __('user::messages.profile') }}</h2></div>
            <form method="POST" action="{{ route('profile.update') }}" class="card__body">
                @csrf
                @method('PATCH')

                <div class="field">
                    <label class="field__label" for="profile-name">{{ __('user::messages.name') }}</label>
                    <input id="profile-name" type="text" name="name" value="{{ old('name', $user->getAttribute('name')) }}" class="input" required>
                    @error('name')<p class="field__error">{{ $message }}</p>@enderror
                </div>

                <div class="field">
                    <label class="field__label" for="profile-email">{{ __('user::messages.email') }}</label>
                    <input id="profile-email" type="email" name="email" value="{{ old('email', $user->getAttribute('email')) }}" class="input" required>
                    @error('email')<p class="field__error">{{ $message }}</p>@enderror
                </div>

                <div class="field">
                    <label class="field__label" for="profile-phone">{{ __('user::messages.phone') }}</label>
                    <input id="profile-phone" type="tel" name="phone" value="{{ old('phone', $user->getAttribute('phone')) }}" class="input">
                    @error('phone')<p class="field__error">{{ $message }}</p>@enderror
                </div>

                <button type="submit" class="button button--primary">{{ __('user::messages.save_changes') }}</button>
            </form>
        </section>

        <section class="card">
            <div class="card__head"><h2 class="card__title">{{ __('user::messages.update_password') }}</h2></div>
            <form method="POST" action="{{ route('password.update') }}" class="card__body">
                @csrf
                @method('PUT')

                <div class="field">
                    <label class="field__label" for="current_password">{{ __('user::messages.current_password') }}</label>
                    <input id="current_password" type="password" name="current_password" class="input" autocomplete="current-password">
                    @error('current_password')<p class="field__error">{{ $message }}</p>@enderror
                </div>

                <div class="field__row field__row--two">
                    <div class="field">
                        <label class="field__label" for="new_password">{{ __('user::messages.new_password') }}</label>
                        <input id="new_password" type="password" name="password" class="input" autocomplete="new-password">
                        @error('password')<p class="field__error">{{ $message }}</p>@enderror
                    </div>
                    <div class="field">
                        <label class="field__label" for="new_password_confirmation">{{ __('user::messages.confirm_password') }}</label>
                        <input id="new_password_confirmation" type="password" name="password_confirmation" class="input" autocomplete="new-password">
                    </div>
                </div>

                <button type="submit" class="button button--secondary">{{ __('user::messages.update_password') }}</button>
            </form>
        </section>

        <section class="card">
            <div class="card__head"><h2 class="card__title">{{ __('user::messages.delete_account') }}</h2></div>
            <div class="card__body">
                <p class="text-muted">{{ __('user::messages.delete_account_lead') }}</p>
                <form method="POST" action="{{ route('profile.destroy') }}" data-confirm="{{ __('user::messages.delete_account_lead') }}" class="stack stack--tight">
                    @csrf
                    @method('DELETE')
                    <div class="field">
                        <label class="field__label" for="delete-password">{{ __('user::messages.password') }}</label>
                        <input id="delete-password" type="password" name="password" class="input" required>
                    </div>
                    <button type="submit" class="button button--critical">{{ __('user::messages.delete_confirm') }}</button>
                </form>
            </div>
        </section>
    </div>

    <aside class="stack stack--loose">
        <section class="card">
            <div class="card__body">
                <div class="row">
                    <span class="avatar avatar--large">{{ $initials }}</span>
                    <div class="stack" style="gap:2px">
                        <p class="title-card">{{ $displayName }}</p>
                        <p class="text-meta">{{ $user->getAttribute('email') }}</p>
                        @if($user->hasVerifiedEmail())
                            <span class="badge badge--positive">{{ __('user::messages.verify_email') }}</span>
                        @else
                            <span class="badge badge--caution">{{ __('user::messages.verify_email') }}</span>
                        @endif
                    </div>
                </div>

                <dl class="spec-list">
                    <div class="spec-list__row">
                        <dt class="spec-list__label">{{ __('panel::messages.my_listings') }}</dt>
                        <dd class="spec-list__value">{{ (int) $user->getAttribute('listings_count') }}</dd>
                    </div>
                    <div class="spec-list__row">
                        <dt class="spec-list__label">{{ __('favorite::messages.saved_listings') }}</dt>
                        <dd class="spec-list__value">{{ (int) $user->getAttribute('favorite_listings_count') }}</dd>
                    </div>
                    <div class="spec-list__row">
                        <dt class="spec-list__label">{{ __('favorite::messages.saved_searches') }}</dt>
                        <dd class="spec-list__value">{{ (int) $user->getAttribute('favorite_searches_count') }}</dd>
                    </div>
                    <div class="spec-list__row">
                        <dt class="spec-list__label">{{ __('favorite::messages.followed_sellers') }}</dt>
                        <dd class="spec-list__value">{{ (int) $user->getAttribute('favorite_sellers_count') }}</dd>
                    </div>
                </dl>
            </div>
        </section>
    </aside>
</div>
@endsection
