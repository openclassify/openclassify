@extends('app::layouts.app')

@section('title', 'My Profile')

@section('content')
@php
    $displayName = trim((string) ($user->name ?: 'User'));
    $initialSeed = trim((string) ($displayName ?: $user->email ?: 'U'));
    $initials = collect(preg_split('/\s+/', $initialSeed) ?: [])
        ->filter()
        ->take(2)
        ->map(fn (string $segment): string => mb_strtoupper(mb_substr($segment, 0, 1)))
        ->implode('');
    $memberSince = $user->created_at?->format('M Y');
    $stats = [
        [
            'label' => 'Listings',
            'value' => (int) ($user->listings_count ?? 0),
            'hint' => 'Ads you manage from your dashboard.',
        ],
        [
            'label' => 'Saved Listings',
            'value' => (int) ($user->favorite_listings_count ?? 0),
            'hint' => 'Items you bookmarked for later.',
        ],
        [
            'label' => 'Saved Searches',
            'value' => (int) ($user->favorite_searches_count ?? 0),
            'hint' => 'Searches you can revisit instantly.',
        ],
        [
            'label' => 'Saved Sellers',
            'value' => (int) ($user->favorite_sellers_count ?? 0),
            'hint' => 'Sellers you want to keep an eye on.',
        ],
    ];
@endphp

<div class="profile-page mx-auto max-w-[1320px] px-4 py-6 md:py-8">
    <div class="grid gap-6 xl:grid-cols-[300px,minmax(0,1fr)]">
        <aside class="profile-side-nav space-y-6">
            <div class="relative overflow-hidden rounded-[30px] border border-slate-200/80 bg-white/90 p-6 shadow-[0_20px_55px_rgba(15,23,42,0.08)] backdrop-blur">
                <div class="absolute inset-x-0 top-0 h-24 bg-gradient-to-r from-sky-500 via-blue-500 to-cyan-400"></div>

                <div class="relative">
                    <div class="flex items-start gap-4">
                        <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-[22px] bg-slate-900 text-xl font-semibold tracking-tight text-white shadow-[0_16px_30px_rgba(15,23,42,0.2)]">
                            {{ $initials !== '' ? $initials : 'U' }}
                        </div>

                        <div class="min-w-0 pt-1">
                            <p class="text-[0.68rem] font-semibold uppercase tracking-[0.26em] text-slate-400">My account</p>
                            <h1 class="mt-2 text-[1.9rem] font-semibold leading-tight text-slate-950">{{ $displayName }}</h1>
                            <p class="mt-1 break-all text-sm text-slate-600">{{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="mt-5 flex flex-wrap gap-2">
                        <span @class([
                            'inline-flex items-center rounded-full px-3 py-1.5 text-xs font-semibold',
                            'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200' => $user->hasVerifiedEmail(),
                            'bg-amber-50 text-amber-700 ring-1 ring-amber-200' => ! $user->hasVerifiedEmail(),
                        ])>
                            {{ $user->hasVerifiedEmail() ? 'Email verified' : 'Verification pending' }}
                        </span>

                        @if ($memberSince)
                            <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600 ring-1 ring-slate-200">
                                Member since {{ $memberSince }}
                            </span>
                        @endif
                    </div>

                    <div class="mt-6 rounded-[24px] bg-slate-950 px-5 py-4 text-white shadow-[0_18px_38px_rgba(15,23,42,0.22)]">
                        <p class="text-[0.68rem] font-semibold uppercase tracking-[0.26em] text-slate-300">Profile visibility</p>
                    </div>
                </div>
            </div>

            @include('panel::partials.sidebar', ['activeMenu' => 'profile'])
        </aside>

        <section class="space-y-6">
            <div class="grid gap-4 sm:grid-cols-2 2xl:grid-cols-4">
                @foreach ($stats as $stat)
                    <div class="rounded-[26px] border border-slate-200/80 bg-white/90 p-5 shadow-[0_16px_40px_rgba(15,23,42,0.06)] backdrop-blur">
                        <p class="text-sm font-semibold text-slate-500">{{ $stat['label'] }}</p>
                        <p class="mt-3 text-4xl font-semibold tracking-[-0.04em] text-slate-950">{{ number_format($stat['value']) }}</p>
                        <p class="mt-2 text-sm leading-6 text-slate-500">{{ $stat['hint'] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="grid gap-6 2xl:grid-cols-[minmax(0,1.2fr),minmax(0,0.8fr)]">
                <div class="panel-surface profile-card">
                    @include('user::profile.partials.update-profile-information-form')
                </div>

                <div class="panel-surface profile-card">
                    @include('user::profile.partials.update-password-form')
                </div>
            </div>

            <div class="panel-surface profile-card profile-card-danger">
                @include('user::profile.partials.delete-user-form')
            </div>
        </section>
    </div>
</div>
@endsection
