@extends('app::layouts.app')

@section('title', 'Favoriler')

@section('content')
<div class="max-w-[1320px] mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-[220px,1fr] gap-4">
        <aside class="bg-white border border-slate-200">
            <a href="{{ route('favorites.index', ['tab' => 'listings']) }}" class="block px-5 py-4 text-base{{ $activeTab === 'listings' ? ' bg-blue-50 text-blue-700 font-semibold' : ' text-slate-700 hover:bg-slate-50' }}">
                Favori İlanlar
            </a>
            <a href="{{ route('favorites.index', ['tab' => 'searches']) }}" class="block px-5 py-4 border-t border-slate-200{{ $activeTab === 'searches' ? ' bg-blue-50 text-blue-700 font-semibold' : ' text-slate-700 hover:bg-slate-50' }}">
                Favori Aramalar
            </a>
            <a href="{{ route('favorites.index', ['tab' => 'sellers']) }}" class="block px-5 py-4 border-t border-slate-200{{ $activeTab === 'sellers' ? ' bg-blue-50 text-blue-700 font-semibold' : ' text-slate-700 hover:bg-slate-50' }}">
                Favori Satıcılar
            </a>
        </aside>

        <section class="bg-white border border-slate-200">
            @if($activeTab === 'listings')
            <div class="border-b-2 border-blue-900 px-4 py-3 flex flex-wrap items-center gap-3">
                <h1 class="text-3xl font-bold text-slate-800 mr-auto">Favori Listem</h1>
                <div class="inline-flex border border-slate-300 overflow-hidden">
                    <a href="{{ route('favorites.index', ['tab' => 'listings', 'status' => 'all', 'category' => $selectedCategoryId]) }}" class="px-5 py-2 text-sm font-semibold {{ $statusFilter === 'all' ? 'bg-slate-700 text-white' : 'bg-white text-slate-700 hover:bg-slate-100' }}">
                        Tümü
                    </a>
                    <a href="{{ route('favorites.index', ['tab' => 'listings', 'status' => 'active', 'category' => $selectedCategoryId]) }}" class="px-5 py-2 text-sm font-semibold border-l border-slate-300 {{ $statusFilter === 'active' ? 'bg-slate-700 text-white' : 'bg-white text-slate-700 hover:bg-slate-100' }}">
                        Yayında
                    </a>
                </div>
                <form method="GET" action="{{ route('favorites.index') }}" class="flex items-center gap-2">
                    <input type="hidden" name="tab" value="listings">
                    <input type="hidden" name="status" value="{{ $statusFilter }}">
                    <select name="category" class="h-10 min-w-44 border border-slate-300 px-3 text-sm text-slate-700">
                        <option value="">Kategori</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected((int) $selectedCategoryId === (int) $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="h-10 px-4 bg-slate-700 text-white text-sm font-semibold hover:bg-slate-800 transition">Filtrele</button>
                </form>
            </div>

            <div class="w-full overflow-x-auto">
                <table class="w-full min-w-[760px]">
                    <thead>
                        <tr class="bg-slate-50 text-slate-700 text-sm">
                            <th class="text-left px-4 py-3 w-[70%]">İlan Başlığı</th>
                            <th class="text-left px-4 py-3 w-[20%]">Fiyat</th>
                            <th class="text-right px-4 py-3 w-[10%]"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($favoriteListings as $listing)
                        @php
                            $listingImage = $listing->getFirstMediaUrl('listing-images');
                            $priceLabel = $listing->price ? number_format((float) $listing->price, 0).' '.$listing->currency : 'Ücretsiz';
                            $meta = collect([
                                $listing->category?->name,
                                $listing->city,
                                $listing->country,
                            ])->filter()->join(' › ');
                        @endphp
                        <tr class="border-t border-slate-200">
                            <td class="px-4 py-4">
                                <div class="flex gap-3">
                                    <a href="{{ route('listings.show', $listing) }}" class="w-36 h-24 shrink-0 bg-slate-100 border border-slate-200 overflow-hidden">
                                        @if($listingImage)
                                        <img src="{{ $listingImage }}" alt="{{ $listing->title }}" class="w-full h-full object-cover">
                                        @else
                                        <div class="w-full h-full grid place-items-center text-slate-400">Görsel yok</div>
                                        @endif
                                    </a>
                                    <div>
                                        <a href="{{ route('listings.show', $listing) }}" class="font-semibold text-2xl text-slate-800 hover:text-blue-700 transition leading-6">
                                            {{ $listing->title }}
                                        </a>
                                        <p class="text-sm text-slate-500 mt-2">{{ $meta !== '' ? $meta : 'Kategori / konum bilgisi yok' }}</p>
                                        <p class="text-xs text-slate-400 mt-1">Favoriye eklenme: {{ $listing->pivot->created_at?->format('d.m.Y') }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-2xl font-bold text-slate-700 whitespace-nowrap">{{ $priceLabel }}</td>
                            <td class="px-4 py-4 text-right">
                                <form method="POST" action="{{ route('favorites.listings.toggle', $listing) }}">
                                    @csrf
                                    <button type="submit" class="text-sm font-semibold text-rose-500 hover:text-rose-600 transition">Kaldır</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr class="border-t border-slate-200">
                            <td colspan="3" class="px-4 py-10 text-center text-slate-500">
                                Henüz favori ilan bulunmuyor.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-4 py-4 border-t border-slate-200 text-sm text-slate-500">
                * Son 1 yıl içinde favoriye eklediğiniz ilanlar listelenmektedir.
            </div>

            @if($favoriteListings?->hasPages())
            <div class="px-4 pb-4">{{ $favoriteListings->links() }}</div>
            @endif
            @endif

            @if($activeTab === 'searches')
            <div class="px-4 py-4 border-b border-slate-200">
                <h1 class="text-3xl font-bold text-slate-800">Favori Aramalar</h1>
                <p class="text-sm text-slate-500 mt-1">Kayıtlı aramalarına tek tıkla geri dön.</p>
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
                        <h2 class="font-semibold text-slate-800">{{ $favoriteSearch->label ?: 'Kayıtlı arama' }}</h2>
                        <p class="text-sm text-slate-500 mt-1">
                            @if($favoriteSearch->search_term) Arama: "{{ $favoriteSearch->search_term }}" · @endif
                            @if($favoriteSearch->category) Kategori: {{ $favoriteSearch->category->name }} · @endif
                            Kaydedilme: {{ $favoriteSearch->created_at?->format('d.m.Y H:i') }}
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ $searchUrl }}" class="inline-flex items-center h-10 px-4 bg-blue-600 text-white text-sm font-semibold rounded hover:bg-blue-700 transition">
                            Aramayı Aç
                        </a>
                        <form method="POST" action="{{ route('favorites.searches.destroy', $favoriteSearch) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center h-10 px-4 border border-slate-300 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                                Sil
                            </button>
                        </form>
                    </div>
                </article>
                @empty
                <div class="px-4 py-10 text-center text-slate-500">
                    Henüz favori arama eklenmedi.
                </div>
                @endforelse
            </div>
            @if($favoriteSearches?->hasPages())
            <div class="px-4 py-4 border-t border-slate-200">{{ $favoriteSearches->links() }}</div>
            @endif
            @endif

            @if($activeTab === 'sellers')
            <div class="px-4 py-4 border-b border-slate-200">
                <h1 class="text-3xl font-bold text-slate-800">Favori Satıcılar</h1>
                <p class="text-sm text-slate-500 mt-1">Takip etmek istediğin satıcıları burada yönetebilirsin.</p>
            </div>
            <div class="divide-y divide-slate-200">
                @forelse($favoriteSellers as $seller)
                <article class="px-4 py-4 flex flex-col md:flex-row md:items-center gap-3">
                    <div class="flex items-center gap-3 flex-1">
                        <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-700 font-bold grid place-items-center">
                            {{ strtoupper(substr((string) $seller->name, 0, 1)) }}
                        </div>
                        <div>
                            <h2 class="font-semibold text-slate-800">{{ $seller->name }}</h2>
                            <p class="text-sm text-slate-500">{{ $seller->email }}</p>
                            <p class="text-xs text-slate-400 mt-1">Aktif ilan: {{ (int) $seller->active_listings_count }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('favorites.sellers.toggle', $seller) }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center h-10 px-4 border border-rose-200 text-sm font-semibold text-rose-600 hover:bg-rose-50 transition">
                            Favoriden Kaldır
                        </button>
                    </form>
                </article>
                @empty
                <div class="px-4 py-10 text-center text-slate-500">
                    Henüz favori satıcı eklenmedi.
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
