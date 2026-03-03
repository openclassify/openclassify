<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    @php
        $socialProviders = collect([
            'google' => 'Google',
            'facebook' => 'Facebook',
            'apple' => 'Apple',
        ])->filter(
            fn ($label, $provider) => (bool) config("services.{$provider}.enabled")
                && filled(config("services.{$provider}.client_id"))
                && filled(config("services.{$provider}.client_secret"))
        );
    @endphp

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        @if($socialProviders->isNotEmpty())
            <div class="mt-6 border-t pt-4">
                <p class="text-sm text-gray-600 mb-3">{{ __('Or continue with') }}</p>

                <div class="grid gap-2">
                    @foreach($socialProviders as $provider => $label)
                        <a href="{{ route('auth.social.redirect', ['provider' => $provider]) }}"
                           class="inline-flex items-center justify-center rounded-md border border-gray-300 px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </form>
</x-guest-layout>
