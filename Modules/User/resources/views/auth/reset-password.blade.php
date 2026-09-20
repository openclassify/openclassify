@extends('user::layouts.auth')

@section('title', __('user::messages.reset_password'))
@section('auth_title', __('user::messages.reset_password'))

@section('auth_body')
<form method="POST" action="{{ route('password.store') }}" class="stack">
    @csrf
    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <div class="field">
        <label class="field__label" for="email">{{ __('user::messages.email') }}</label>
        <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" class="input" required autofocus>
        @error('email')<p class="field__error">{{ $message }}</p>@enderror
    </div>

    <div class="field">
        <label class="field__label" for="password">{{ __('user::messages.password') }}</label>
        <input id="password" type="password" name="password" class="input" required autocomplete="new-password">
        @error('password')<p class="field__error">{{ $message }}</p>@enderror
    </div>

    <div class="field">
        <label class="field__label" for="password_confirmation">{{ __('user::messages.confirm_password') }}</label>
        <input id="password_confirmation" type="password" name="password_confirmation" class="input" required autocomplete="new-password">
    </div>

    <button type="submit" class="button button--primary button--block button--large">{{ __('user::messages.reset_password') }}</button>
</form>
@endsection
