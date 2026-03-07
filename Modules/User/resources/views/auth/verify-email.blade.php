@extends('user::layouts.auth')

@section('title', 'Verify email')

@section('content')
<div class="user-auth-copy">
    <p class="user-auth-kicker">Verification</p>
    <h1 class="user-auth-title">Verify your email</h1>
    <p class="user-auth-subtitle">Before you continue, confirm your email address from the link we sent you.</p>
</div>

@if (session('status') === 'verification-link-sent')
<div class="user-auth-status is-success">A fresh verification link has been sent to your inbox.</div>
@endif

<div class="user-auth-actions-stack">
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="user-auth-primary">Resend verification email</button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="user-auth-secondary">Log out</button>
    </form>
</div>
@endsection
