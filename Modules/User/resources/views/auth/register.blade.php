@extends('user::layouts.auth')

@section('title', 'Create account')

@section('content')
<div class="user-auth-copy">
    <p class="user-auth-kicker">Account</p>
    <h1 class="user-auth-title">Create account</h1>
</div>

<form method="POST" action="{{ route('register') }}" class="user-auth-form">
    @csrf

    @if(filled($redirectTo))
    <input type="hidden" name="redirect" value="{{ $redirectTo }}">
    @endif

    <div class="user-auth-grid">
        <div class="user-auth-field">
            <label for="first_name" class="user-auth-label">First name</label>
            <input
                id="first_name"
                name="first_name"
                type="text"
                value="{{ old('first_name') }}"
                class="user-auth-input"
                autocomplete="given-name"
                required
                autofocus
                placeholder="First name"
            >
            @error('first_name')
            <p class="user-auth-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="user-auth-field">
            <label for="last_name" class="user-auth-label">Last name</label>
            <input
                id="last_name"
                name="last_name"
                type="text"
                value="{{ old('last_name') }}"
                class="user-auth-input"
                autocomplete="family-name"
                required
                placeholder="Last name"
            >
            @error('last_name')
            <p class="user-auth-error">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="user-auth-field">
        <label for="email" class="user-auth-label">Email address</label>
        <input
            id="email"
            name="email"
            type="email"
            value="{{ old('email') }}"
            class="user-auth-input"
            autocomplete="username"
            required
            placeholder="Enter your email"
        >
        @error('email')
        <p class="user-auth-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="user-auth-field" x-data="{ show: false }">
        <label for="password" class="user-auth-label">Password</label>
        <div class="user-auth-input-wrap">
            <input
                id="password"
                name="password"
                x-bind:type="show ? 'text' : 'password'"
                class="user-auth-input has-trailing"
                autocomplete="new-password"
                required
                placeholder="Create a password"
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

    <div class="user-auth-checkbox-list">
        <label class="user-auth-checkbox">
            <input type="checkbox" name="terms" value="1" @checked(old('terms')) required>
            <span>Accept terms</span>
        </label>
        @error('terms')
        <p class="user-auth-error">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="user-auth-primary">
        Create account
    </button>
</form>

<p class="user-auth-switch">
    Already have an account?
    <a href="{{ route('login', array_filter(['redirect' => $redirectTo])) }}" class="user-auth-link">Sign in</a>
</p>

@include('user::auth.partials.social-buttons', ['socialProviders' => $socialProviders])
@endsection
