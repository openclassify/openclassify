<section class="space-y-8">
    <header class="flex flex-col gap-4 border-b border-rose-200/80 pb-6 lg:flex-row lg:items-start lg:justify-between">
        <div>
            <p class="account-section-kicker text-rose-500">{{ __('Danger Zone') }}</p>
            <h2 class="mt-2 text-2xl font-semibold tracking-[-0.03em] text-slate-950">
                {{ __('Delete Account') }}
            </h2>
            <p class="mt-2 max-w-3xl text-sm leading-6 text-slate-500">
                {{ __('Deleting your account permanently removes your listings, favorites, and personal data. This cannot be undone.') }}
            </p>
        </div>

        <button
            type="button"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="account-danger-button"
        >
            {{ __('Delete Account') }}
        </button>
    </header>

    <div class="rounded-[26px] border border-rose-200 bg-rose-50/80 p-5">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm font-semibold text-rose-900">{{ __('Before you continue') }}</p>
                <p class="mt-1 text-sm leading-6 text-rose-900/80">
                    {{ __('Download anything you need to keep. Once deletion is confirmed, the account is removed immediately.') }}
                </p>
            </div>

            <button
                type="button"
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                class="account-secondary-button border-rose-200 bg-white text-rose-700 hover:border-rose-300 hover:text-rose-800"
            >
                {{ __('Review Deletion') }}
            </button>
        </div>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="space-y-6 p-6 sm:p-8">
            @csrf
            @method('delete')

            <div>
                <p class="account-section-kicker text-rose-500">{{ __('Final Confirmation') }}</p>
                <h2 class="mt-2 text-2xl font-semibold tracking-[-0.03em] text-slate-950">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>
                <p class="mt-2 text-sm leading-6 text-slate-500">
                    {{ __('Enter your password to confirm permanent deletion. This action cannot be reversed.') }}
                </p>
            </div>

            <div class="account-field">
                <label for="password" class="account-label">{{ __('Password') }}</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="{{ __('Password') }}"
                    class="account-input"
                >

                @foreach ($errors->userDeletion->get('password') as $message)
                    <p class="account-error">{{ $message }}</p>
                @endforeach
            </div>

            <div class="flex flex-col-reverse gap-3 border-t border-slate-200/80 pt-6 sm:flex-row sm:justify-end">
                <button type="button" x-on:click="$dispatch('close')" class="account-secondary-button">
                    {{ __('Cancel') }}
                </button>

                <button type="submit" class="account-danger-button">
                    {{ __('Permanently Delete') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
