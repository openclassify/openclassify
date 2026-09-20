@extends('user::layouts.auth')

@section('title', __('user::messages.confirm_password'))
@section('auth_title', __('user::messages.confirm_password'))
@section('auth_lead', __('user::messages.confirm_lead'))

@section('auth_body')
<form method="POST" action="{{ route('password.confirm') }}" class="stack">
    @csrf
    <div class="field">
        <label class="field__label" for="password">{{ __('user::messages.password') }}</label>
        <input id="password" type="password" name="password" class="input" required autofocus autocomplete="current-password">
        @error('password')<p class="field__error">{{ $message }}</p>@enderror
    </div>
    <button type="submit" class="button button--primary button--block button--large">{{ __('user::messages.confirm') }}</button>
</form>
@endsection
