@extends('user::layouts.auth')

@section('title', __('user::messages.forgot_password'))
@section('auth_title', __('user::messages.forgot_password'))
@section('auth_lead', __('user::messages.forgot_lead'))

@section('auth_body')
<form method="POST" action="{{ route('password.email') }}" class="stack">
    @csrf
    <div class="field">
        <label class="field__label" for="email">{{ __('user::messages.email') }}</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" class="input" required autofocus>
        @error('email')<p class="field__error">{{ $message }}</p>@enderror
    </div>
    <button type="submit" class="button button--primary button--block button--large">{{ __('user::messages.send_reset_link') }}</button>
</form>
@endsection

@section('auth_footer')
<a href="{{ route('login') }}" class="text-link">{{ __('site::messages.back') }}</a>
@endsection
