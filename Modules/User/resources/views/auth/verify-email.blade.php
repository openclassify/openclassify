@extends('user::layouts.auth')

@section('title', __('user::messages.verify_email'))
@section('auth_title', __('user::messages.verify_email'))
@section('auth_lead', __('user::messages.verify_lead'))

@section('auth_body')
<div class="stack">
    @if(session('status') === 'verification-link-sent')
        <div class="alert alert--positive"><x-ui.icon name="check"/><span>{{ __('user::messages.verification_sent') }}</span></div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="button button--primary button--block">{{ __('user::messages.resend_verification') }}</button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="button button--ghost button--block">{{ __('site::messages.logout') }}</button>
    </form>
</div>
@endsection
