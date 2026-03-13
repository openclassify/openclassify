@extends('app::layouts.app')

@section('title', 'Favorites')

@section('content')
<div class="max-w-[1320px] mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-[220px,1fr] gap-4">
        @include('panel::partials.sidebar', ['activeMenu' => 'favorites', 'activeFavoritesTab' => $activeTab])

        <section class="bg-white border border-slate-200">
            @if($requiresLogin ?? false)
            <div class="border-b border-slate-200 px-5 py-4 bg-slate-50 flex flex-wrap items-center justify-between gap-3">
                <div>
                    <h1 class="text-xl font-semibold text-slate-900">Favorites</h1>
                    <p class="text-sm text-slate-500 mt-1">Stay on this page and log in when you want to sync saved listings, searches, and sellers.</p>
                </div>
                <a href="{{ route('login', ['redirect' => request()->fullUrl()]) }}" class="inline-flex items-center justify-center rounded-full bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white hover:bg-slate-800 transition">
                    Log in
                </a>
            </div>
            @endif

            @if($activeTab === 'listings')
            @php
                $listingTabQuery = array_filter([
                    'tab' => 'listings',
                    'status' => $statusFilter,
                    'category' => $selectedCategoryId,
                ], fn ($value) => !is_null($value) && $value !== '');
            @endphp
            <div class="border-b-2 border-blue-900 px-4 py-3 flex flex-wrap items-center gap-3">
                <h1 class="text-3xl font-bold text-slate-800 mr-auto">Saved Listings</h1>
                <div class="inline-flex border border-slate-300 overflow-hidden">
                    <a href="{{ route('favorites.index', array_merge($listingTabQuery, ['status' => 'all'])) }}" class="px-5 py-2 text-sm font-semibold {{ $statusFilter === 'all' ? 'bg-slate-700 text-white' : 'bg-white text-slate-700 hover:bg-slate-100' }}">
                        All
                    </a>
                    <a href="{{ route('favorites.index', array_merge($listingTabQuery, ['status' => 'active'])) }}" class="px-5 py-2 text-sm font-semibold border-l border-slate-300 {{ $statusFilter === 'active' ? 'bg-slate-700 text-white' : 'bg-white text-slate-700 hover:bg-slate-100' }}">
                        Live
                    </a>
                </div>
                <form method="GET" action="{{ route('favorites.index') }}" class="flex items-center gap-2">
                    <input type="hidden" name="tab" value="listings">
                    <input type="hidden" name="status" value="{{ $statusFilter }}">
                    <select name="category" class="h-10 min-w-44 border border-slate-300 px-3 text-sm text-slate-700">
                        <option value="">Category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected((int) $selectedCategoryId === (int) $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="h-10 px-4 bg-slate-700 text-white text-sm font-semibold hover:bg-slate-800 transition">Filter</button>
                </form>
            </div>

            <div class="w-full overflow-x-auto">
                <table class="w-full min-w-[860px]">
                    <thead>
                        <tr class="bg-slate-50 text-slate-700 text-sm">
                            <th class="text-left px-4 py-3 w-[58%]">Listing</th>
                            <th class="text-left px-4 py-3 w-[16%]">Price</th>
                            <th class="text-left px-4 py-3 w-[14%]">Messaging</th>
                            <th class="text-right px-4 py-3 w-[12%]"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($favoriteListings as $listing)
                        @php
                            $listingImage = $listing->primaryImageData('card');
                            $priceLabel = $listing->price ? number_format((float) $listing->price, 0).' '.$listing->currency : 'Free';
                            $meta = collect([
                                $listing->category?->name,
                                $listing->city,
                                $listing->country,
                            ])->filter()->join(' › ');
                            $conversationId = $buyerConversationListingMap[$listing->id] ?? null;
                            $isOwnListing = (int) $listing->user_id === (int) auth()->id();
                            $canMessageListing = !is_null($listing->user_id) && ! $isOwnListing;
                        @endphp
                        <tr class="border-t border-slate-200">
                            <td class="px-4 py-4">
                                <div class="flex gap-3">
                                    <a href="{{ route('listings.show', $listing) }}" class="w-36 h-24 shrink-0 bg-slate-100 border border-slate-200 overflow-hidden">
                                        @if($listingImage)
                                        @include('listing::partials.responsive-image', [
                                            'image' => $listingImage,
                                            'alt' => $listing->title,
                                            'class' => 'w-full h-full object-cover',
                                        ])
                                        @else
                                        <div class="w-full h-full grid place-items-center text-slate-400">No image</div>
                                        @endif
                                    </a>
                                    <div>
                                        <a href="{{ route('listings.show', $listing) }}" class="font-semibold text-2xl text-slate-800 hover:text-blue-700 transition leading-6">
                                            {{ $listing->title }}
                                        </a>
                                        <p class="text-sm text-slate-500 mt-2">{{ $meta !== '' ? $meta : 'No category or location data' }}</p>
                                        <p class="text-xs text-slate-400 mt-1">Saved on: {{ $listing->pivot->created_at?->format('M j, Y') }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-2xl font-bold text-slate-700 whitespace-nowrap">{{ $priceLabel }}</td>
                            <td class="px-4 py-4">
                                @if($canMessageListing)
                                    @if($conversationId)
                                    <a href="{{ route('panel.inbox.index', ['conversation' => $conversationId]) }}" class="inline-flex items-center h-10 px-4 border border-rose-300 text-rose-600 text-sm font-semibold rounded-full hover:bg-rose-50 transition">
                                        Open chat
                                    </a>
                                    @else
                                    <form method="POST" action="{{ route('conversations.start', $listing) }}">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center h-10 px-4 bg-rose-500 text-white text-sm font-semibold rounded-full hover:bg-rose-600 transition">
                                            Send message
                                        </button>
                                    </form>
                                    @endif
                                @else
                                <span class="text-xs text-slate-400">{{ $isOwnListing ? 'Your own listing' : 'Seller unavailable' }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-right">
                                <form method="POST" action="{{ route('favorites.listings.toggle', $listing) }}">
                                    @csrf
                                    <button type="submit" class="text-sm font-semibold text-rose-500 hover:text-rose-600 transition">Remove</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr class="border-t border-slate-200">
                            <td colspan="4" class="px-4 py-10 text-center text-slate-500">
                                No saved listings yet.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-4 py-4 border-t border-slate-200 text-sm text-slate-500">
                * Listings saved within the last year are shown here.
            </div>

            @if($favoriteListings?->hasPages())
            <div class="px-4 pb-4">{{ $favoriteListings->links() }}</div>
            @endif
            @endif

            @if($activeTab === 'searches')
            <div class="px-4 py-4 border-b border-slate-200">
                <h1 class="text-3xl font-bold text-slate-800">Saved Searches</h1>
                <p class="text-sm text-slate-500 mt-1">Return to your saved searches with one click.</p>
            </div>
            <div class="divide-y divide-slate-200">
                @forelse($favoriteSearches as $favoriteSearch)
                @php
                    $searchUrl = route('listings.index', array_filter([
                        'search' => $favoriteSearch->search_term,
                        'category' => $favoriteSearch->category_id,
                    ]));
                @endphp
                <article class="px-4 py-4 flex flex-col md:flex-row md:items-center gap-3">
                    <div class="flex-1">
                        <h2 class="font-semibold text-slate-800">{{ $favoriteSearch->label ?: 'Saved search' }}</h2>
                        <p class="text-sm text-slate-500 mt-1">
                            @if($favoriteSearch->search_term) Search: "{{ $favoriteSearch->search_term }}" · @endif
                            @if($favoriteSearch->category) Category: {{ $favoriteSearch->category->name }} · @endif
                            Saved: {{ $favoriteSearch->created_at?->format('M j, Y H:i') }}
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ $searchUrl }}" class="inline-flex items-center h-10 px-4 bg-blue-600 text-white text-sm font-semibold rounded hover:bg-blue-700 transition">
                            Open search
                        </a>
                        <form method="POST" action="{{ route('favorites.searches.destroy', $favoriteSearch) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center h-10 px-4 border border-slate-300 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                                Delete
                            </button>
                        </form>
                    </div>
                </article>
                @empty
                <div class="px-4 py-10 text-center text-slate-500">
                    No saved searches yet.
                </div>
                @endforelse
            </div>
            @if($favoriteSearches?->hasPages())
            <div class="px-4 py-4 border-t border-slate-200">{{ $favoriteSearches->links() }}</div>
            @endif
            @endif

            @if($activeTab === 'sellers')
            <div class="px-4 py-4 border-b border-slate-200">
                <h1 class="text-3xl font-bold text-slate-800">Saved Sellers</h1>
                <p class="text-sm text-slate-500 mt-1">Manage the sellers you want to follow here.</p>
            </div>
            <div class="divide-y divide-slate-200">
                @forelse($favoriteSellers as $seller)
                <article class="px-4 py-4 flex flex-col md:flex-row md:items-center gap-3">
                    <a href="{{ route('listings.index', ['user' => $seller->id]) }}" class="flex items-center gap-3 flex-1 hover:opacity-90 transition">
                        <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-700 font-bold grid place-items-center">
                            {{ strtoupper(substr((string) $seller->name, 0, 1)) }}
                        </div>
                        <div>
                            <h2 class="font-semibold text-slate-800">{{ $seller->name }}</h2>
                            <p class="text-sm text-slate-500">{{ $seller->email }}</p>
                            <p class="text-xs text-slate-400 mt-1">Active listings: {{ (int) $seller->active_listings_count }}</p>
                        </div>
                    </a>
                    <form method="POST" action="{{ route('favorites.sellers.toggle', $seller) }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center h-10 px-4 border border-rose-200 text-sm font-semibold text-rose-600 hover:bg-rose-50 transition">
                            Remove seller
                        </button>
                    </form>
                </article>
                @empty
                <div class="px-4 py-10 text-center text-slate-500">
                    No saved sellers yet.
                </div>
                @endforelse
            </div>
            @if($favoriteSellers?->hasPages())
            <div class="px-4 py-4 border-t border-slate-200">{{ $favoriteSellers->links() }}</div>
            @endif
            @endif
        </section>
    </div>
</div>
@endsection
