@extends('user::layouts.auth')

@section('title', __('site::messages.login'))
@section('auth_title', __('user::messages.welcome_back'))
@section('auth_lead', __('user::messages.login_lead'))

@section('auth_body')
<form method="POST" action="{{ route('login') }}" class="stack">
    @csrf

    <div class="field">
        <label class="field__label" for="email">{{ __('user::messages.email') }}</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" class="input" required autofocus autocomplete="username"
               aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}">
        @error('email')<p class="field__error">{{ $message }}</p>@enderror
    </div>

    <div class="field">
        <div class="row row--between">
            <label class="field__label" for="password">{{ __('user::messages.password') }}</label>
            @if(Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-link" style="font-size:var(--text-xs)">{{ __('user::messages.forgot_password') }}</a>
            @endif
        </div>
        <input id="password" type="password" name="password" class="input" required autocomplete="current-password"
               aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}">
        @error('password')<p class="field__error">{{ $message }}</p>@enderror
    </div>

    <label class="checkbox">
        <input type="checkbox" name="remember">
        <span>{{ __('user::messages.remember_me') }}</span>
    </label>

    <button type="submit" class="button button--primary button--block button--large">{{ __('site::messages.login') }}</button>

    @include('user::auth.partials.social-buttons')
</form>
@endsection

@section('auth_footer')
{{ __('user::messages.no_account') }} <a href="{{ route('register') }}" class="text-link">{{ __('site::messages.register') }}</a>
@endsection
