@extends('user::layouts.auth')

@section('title', 'Reset password')

@section('content')
<div class="user-auth-copy">
    <p class="user-auth-kicker">Password</p>
    <h1 class="user-auth-title">Reset password</h1>
    <p class="user-auth-subtitle">Enter your email and we will send a secure reset link.</p>
</div>

@if (session('status'))
<div class="user-auth-status is-success">{{ session('status') }}</div>
@endif

<form method="POST" action="{{ route('password.email') }}" class="user-auth-form">
    @csrf

    <div class="user-auth-field">
        <label for="email" class="user-auth-label">Email address</label>
        <input
            id="email"
            name="email"
            type="email"
            value="{{ old('email') }}"
            class="user-auth-input"
            required
            autofocus
            placeholder="Enter your email"
        >
        @error('email')
        <p class="user-auth-error">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="user-auth-primary">Send reset link</button>
</form>

<p class="user-auth-switch">
    Remembered your password?
    <a href="{{ route('login') }}" class="user-auth-link">Back to sign in</a>
</p>
@endsection
