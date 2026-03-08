@php
    $activeMenu = $activeMenu ?? '';
    $activeFavoritesTab = $activeFavoritesTab ?? '';
    $primaryItems = [
        [
            'label' => 'Sell',
            'route' => route('panel.listings.create'),
            'key' => 'create',
        ],
        [
            'label' => 'My Listings',
            'route' => route('panel.listings.index'),
            'key' => 'listings',
        ],
        [
            'label' => 'Videos',
            'route' => route('panel.videos.index'),
            'key' => 'videos',
        ],
        [
            'label' => 'Inbox',
            'route' => route('panel.inbox.index'),
            'key' => 'inbox',
        ],
        [
            'label' => 'My Profile',
            'route' => route('panel.profile.edit'),
            'key' => 'profile',
        ],
    ];
    $favoriteItems = [
        [
            'label' => 'Saved Listings',
            'route' => route('favorites.index', ['tab' => 'listings']),
            'key' => 'listings',
        ],
        [
            'label' => 'Saved Searches',
            'route' => route('favorites.index', ['tab' => 'searches']),
            'key' => 'searches',
        ],
        [
            'label' => 'Saved Sellers',
            'route' => route('favorites.index', ['tab' => 'sellers']),
            'key' => 'sellers',
        ],
    ];
    $favoritesActive = $activeMenu === 'favorites' || $activeFavoritesTab !== '';
@endphp

<aside class="panel-side-nav rounded-[28px] border border-slate-200/80 bg-white/90 p-3 shadow-[0_20px_48px_rgba(15,23,42,0.08)] backdrop-blur">
    <nav class="space-y-1.5">
        @foreach ($primaryItems as $item)
            <a
                href="{{ $item['route'] }}"
                data-level="primary"
                @class([
                    'group flex items-center justify-between gap-3 rounded-2xl px-4 py-3.5 text-sm font-semibold transition',
                    'bg-slate-900 text-white shadow-[0_16px_30px_rgba(15,23,42,0.16)]' => $activeMenu === $item['key'],
                    'text-slate-700 hover:bg-slate-50 hover:text-slate-900' => $activeMenu !== $item['key'],
                ])
            >
                <span>{{ $item['label'] }}</span>
                <span
                    @class([
                        'inline-flex h-7 min-w-7 items-center justify-center rounded-full px-2 text-[0.65rem] font-bold uppercase tracking-[0.18em]',
                        'bg-white/16 text-white' => $activeMenu === $item['key'],
                        'bg-slate-100 text-slate-400 group-hover:bg-white group-hover:text-slate-700' => $activeMenu !== $item['key'],
                    ])
                >
                    {{ $activeMenu === $item['key'] ? 'Open' : 'Go' }}
                </span>
            </a>
        @endforeach

        <div class="rounded-[22px] bg-slate-50/80 p-2">
            <a
                href="{{ route('favorites.index', ['tab' => 'listings']) }}"
                data-level="primary"
                @class([
                    'flex items-center justify-between gap-3 rounded-2xl px-4 py-3.5 text-sm font-semibold transition',
                    'bg-white text-slate-900 shadow-sm ring-1 ring-slate-200' => $favoritesActive,
                    'text-slate-700 hover:bg-white hover:text-slate-900' => ! $favoritesActive,
                ])
            >
                <span>Favorites</span>
                <span
                    @class([
                        'inline-flex h-7 min-w-7 items-center justify-center rounded-full px-2 text-[0.65rem] font-bold uppercase tracking-[0.18em]',
                        'bg-sky-100 text-sky-700' => $favoritesActive,
                        'bg-slate-200 text-slate-500' => ! $favoritesActive,
                    ])
                >
                    {{ $favoritesActive ? 'On' : 'View' }}
                </span>
            </a>

            <div class="mt-2 space-y-1">
                @foreach ($favoriteItems as $item)
                    <a
                        href="{{ $item['route'] }}"
                        data-level="secondary"
                        @class([
                            'flex items-center justify-between gap-3 rounded-xl px-4 py-2.5 text-sm transition',
                            'bg-white text-slate-900 ring-1 ring-slate-200' => $activeFavoritesTab === $item['key'],
                            'text-slate-500 hover:bg-white hover:text-slate-800' => $activeFavoritesTab !== $item['key'],
                        ])
                    >
                        <span>{{ $item['label'] }}</span>
                        <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 6l6 6-6 6"/>
                        </svg>
                    </a>
                @endforeach
            </div>
        </div>
    </nav>
</aside>
