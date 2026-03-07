<section class="space-y-8">
    <header class="flex flex-col gap-4 border-b border-slate-200/80 pb-6">
        <div>
            <p class="account-section-kicker">{{ __('Security') }}</p>
            <h2 class="mt-2 text-2xl font-semibold tracking-[-0.03em] text-slate-950">
                {{ __('Update Password') }}
            </h2>
            <p class="mt-2 text-sm leading-6 text-slate-500">
                {{ __('Use a unique password that you do not reuse anywhere else.') }}
            </p>
        </div>

        <div class="rounded-[24px] bg-slate-50 px-4 py-4 ring-1 ring-slate-200">
            <p class="text-sm font-semibold text-slate-800">{{ __('Recommended') }}</p>
            <p class="mt-1 text-sm leading-6 text-slate-500">
                {{ __('Choose at least 8 characters and mix letters, numbers, and symbols for a stronger account.') }}
            </p>
        </div>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div class="account-field">
            <label for="update_password_current_password" class="account-label">{{ __('Current Password') }}</label>
            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"
                class="account-input"
            >
            @foreach ($errors->updatePassword->get('current_password') as $message)
                <p class="account-error">{{ $message }}</p>
            @endforeach
        </div>

        <div class="grid gap-5 xl:grid-cols-2">
            <div class="account-field">
                <label for="update_password_password" class="account-label">{{ __('New Password') }}</label>
                <input
                    id="update_password_password"
                    name="password"
                    type="password"
                    autocomplete="new-password"
                    class="account-input"
                >
                @foreach ($errors->updatePassword->get('password') as $message)
                    <p class="account-error">{{ $message }}</p>
                @endforeach
            </div>

            <div class="account-field">
                <label for="update_password_password_confirmation" class="account-label">{{ __('Confirm Password') }}</label>
                <input
                    id="update_password_password_confirmation"
                    name="password_confirmation"
                    type="password"
                    autocomplete="new-password"
                    class="account-input"
                >
                @foreach ($errors->updatePassword->get('password_confirmation') as $message)
                    <p class="account-error">{{ $message }}</p>
                @endforeach
            </div>
        </div>

        <div class="flex flex-col gap-4 border-t border-slate-200/80 pt-6 sm:flex-row sm:items-center sm:justify-between">
            <p class="max-w-xl text-sm leading-6 text-slate-500">
                {{ __('After saving, use the new password next time you sign in.') }}
            </p>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                @if (session('status') === 'password-updated')
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

                <button type="submit" class="account-primary-button">
                    {{ __('Update Password') }}
                </button>
            </div>
        </div>
    </form>
</section>
