@extends('site::layouts.app')

@section('chromeless', '1')

@section('content')
<div class="shell shell--form" style="padding-block: var(--space-12) var(--space-16)">
    <div class="stack stack--loose">
        <a href="{{ route('home') }}" class="brand" style="justify-content:center">
            <span class="brand__mark">{{ mb_substr($generalSettings['site_name'] ?? config('app.name'), 0, 1) }}</span>
            <span class="brand__name">{{ $generalSettings['site_name'] ?? config('app.name') }}</span>
        </a>

        <div class="card">
            <div class="card__body">
                <header class="stack stack--tight">
                    <h1 class="title-section">@yield('auth_title')</h1>
                    @hasSection('auth_lead')
                        <p class="text-muted">@yield('auth_lead')</p>
                    @endif
                </header>

                <x-ui.flash/>

                @yield('auth_body')
            </div>
        </div>

        @hasSection('auth_footer')
            <p class="text-muted" style="text-align:center">@yield('auth_footer')</p>
        @endif
    </div>
</div>
@endsection
