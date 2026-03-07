@php
    $profileErrors = $errors->updateProfile;
@endphp

<section class="space-y-8">
    <header class="flex flex-col gap-4 border-b border-slate-200/80 pb-6 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <p class="account-section-kicker">{{ __('Public Details') }}</p>
            <h2 class="mt-2 text-2xl font-semibold tracking-[-0.03em] text-slate-950">
                {{ __('Profile Information') }}
            </h2>
            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">
                {{ __("Update your account's display name and primary email address.") }}
            </p>
        </div>

        @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition.opacity.duration.300ms
                x-init="setTimeout(() => show = false, 2400)"
                class="account-inline-badge bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200"
            >
                {{ __('Saved') }}
            </p>
        @endif
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-8">
        @csrf
        @method('patch')

        <div class="grid gap-5 lg:grid-cols-2">
            <div class="account-field">
                <label for="name" class="account-label">{{ __('Name') }}</label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name', $user->name) }}"
                    autocomplete="name"
                    required
                    autofocus
                    class="account-input"
                >
                @foreach ($profileErrors->get('name') as $message)
                    <p class="account-error">{{ $message }}</p>
                @endforeach
            </div>

            <div class="account-field">
                <label for="email" class="account-label">{{ __('Email') }}</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email', $user->email) }}"
                    autocomplete="username"
                    required
                    class="account-input"
                >
                <p class="account-helper">{{ __('We use this email for sign-in, alerts, and buyer communication.') }}</p>
                @foreach ($profileErrors->get('email') as $message)
                    <p class="account-error">{{ $message }}</p>
                @endforeach
            </div>
        </div>

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="rounded-[24px] border border-amber-200 bg-amber-50/80 p-5">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <p class="text-sm font-semibold text-amber-900">{{ __('Your email address is unverified.') }}</p>
                        <p class="mt-1 text-sm leading-6 text-amber-800/80">
                            {{ __('Verify it to keep your account secure and receive account-related notifications without interruption.') }}
                        </p>
                    </div>

                    <button type="submit" form="send-verification" class="account-secondary-button">
                        {{ __('Send verification email') }}
                    </button>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-4 rounded-2xl bg-white/70 px-4 py-3 text-sm font-medium text-emerald-700 ring-1 ring-emerald-200">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            </div>
        @endif

        <div class="flex flex-col gap-4 border-t border-slate-200/80 pt-6 sm:flex-row sm:items-center sm:justify-between">
            <p class="max-w-2xl text-sm leading-6 text-slate-500">
                {{ __('Keep these details accurate so your listings and messages always point back to the right account.') }}
            </p>

            <button type="submit" class="account-primary-button">
                {{ __('Save Changes') }}
            </button>
        </div>
    </form>
</section>
