@extends('user::layouts.auth')

@section('title', 'Confirm password')

@section('content')
<div class="user-auth-copy">
    <p class="user-auth-kicker">Security</p>
    <h1 class="user-auth-title">Confirm password</h1>
    <p class="user-auth-subtitle">This is a secure area. Enter your password once to continue.</p>
</div>

<form method="POST" action="{{ route('password.confirm') }}" class="user-auth-form">
    @csrf

    <div class="user-auth-field" x-data="{ show: false }">
        <label for="password" class="user-auth-label">Password</label>
        <div class="user-auth-input-wrap">
            <input
                id="password"
                name="password"
                x-bind:type="show ? 'text' : 'password'"
                class="user-auth-input has-trailing"
                required
                autocomplete="current-password"
                autofocus
                placeholder="Enter your password"
            >
            <button type="button" class="user-auth-toggle" x-on:click="show = !show" x-bind:aria-label="show ? 'Hide password' : 'Show password'">
                <svg x-show="!show" viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/>
                    <circle cx="12" cy="12" r="3" stroke-width="1.8"/>
                </svg>
                <svg x-show="show" x-cloak viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m3 3 18 18M10.6 10.6A3 3 0 0 0 14.8 14.8M9.9 5.1A10.4 10.4 0 0 1 12 4.9c6 0 9.5 6 9.5 6a17.6 17.6 0 0 1-2.8 3.5M6.2 6.3C3.8 8 2.5 10.1 2.5 10.1s3.5 6 9.5 6c1.6 0 3.1-.3 4.4-.8"/>
                </svg>
            </button>
        </div>
        @error('password')
        <p class="user-auth-error">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="user-auth-primary">Confirm password</button>
</form>
@endsection
