@php
    $socialProviders = collect($socialProviders ?? [])->values();
@endphp

@if($socialProviders->isNotEmpty())
<div class="user-auth-divider" aria-hidden="true">
    <span>OR</span>
</div>

<div class="user-auth-social-list">
    @foreach($socialProviders as $provider)
    <a href="{{ $provider['url'] }}" class="user-auth-social-button">
        <span class="user-auth-social-icon" aria-hidden="true">
            @switch($provider['id'])
                @case('google')
                <svg viewBox="0 0 24 24" class="h-5 w-5">
                    <path fill="#EA4335" d="M12 10.2v3.9h5.5c-.2 1.2-.9 2.2-1.8 2.9l3 2.3c1.8-1.6 2.8-4 2.8-6.9 0-.7-.1-1.5-.2-2.2H12Z"/>
                    <path fill="#34A853" d="M12 21c2.5 0 4.7-.8 6.3-2.2l-3-2.3c-.8.6-2 .9-3.3.9-2.5 0-4.6-1.7-5.4-4l-3.1 2.4A9.5 9.5 0 0 0 12 21Z"/>
                    <path fill="#4A90E2" d="M6.6 13.4a5.6 5.6 0 0 1 0-2.8L3.5 8.2a9.5 9.5 0 0 0 0 8.5l3.1-2.4Z"/>
                    <path fill="#FBBC05" d="M12 6.6c1.4 0 2.7.5 3.7 1.4l2.8-2.8A9.5 9.5 0 0 0 3.5 8.2l3.1 2.4c.8-2.3 2.9-4 5.4-4Z"/>
                </svg>
                @break

                @case('apple')
                <svg viewBox="0 0 24 24" class="h-5 w-5 fill-current">
                    <path d="M16.7 12.6c0-2 1.6-3 1.7-3.1-1-1.5-2.6-1.7-3.2-1.7-1.4-.2-2.7.8-3.4.8-.7 0-1.8-.8-3-.8-1.5 0-2.9.9-3.7 2.2-1.6 2.7-.4 6.7 1.1 8.8.7 1 1.6 2.1 2.8 2 .8 0 1.2-.5 2.2-.5s1.4.5 2.3.5c1.2 0 1.9-1 2.6-2 .8-1.2 1.2-2.4 1.2-2.5 0 0-2.3-.9-2.4-3.7Zm-2.3-6.2c.6-.8 1-1.9.9-3-.9 0-2 .6-2.7 1.3-.6.7-1.1 1.8-.9 2.9 1 0 2-.5 2.7-1.2Z"/>
                </svg>
                @break

                @default
                <svg viewBox="0 0 24 24" class="h-5 w-5 fill-current text-[#1877F2]">
                    <path d="M24 12.1C24 5.4 18.6 0 12 0S0 5.4 0 12.1c0 6 4.4 11 10.1 12v-8.4H7.1v-3.6h3V9.3c0-3 1.8-4.7 4.5-4.7 1.3 0 2.7.2 2.7.2v3h-1.5c-1.5 0-2 .9-2 1.9v2.3h3.4l-.5 3.6h-2.9V24C19.6 23.1 24 18.2 24 12.1Z"/>
                </svg>
            @endswitch
        </span>
        <span>{{ $provider['button_label'] }}</span>
    </a>
    @endforeach
</div>
@endif
