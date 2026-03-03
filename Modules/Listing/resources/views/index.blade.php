@extends('app::layouts.app')
@section('content')
<div class="max-w-[1320px] mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row lg:items-center gap-4 mb-6">
        <h1 class="text-3xl font-bold text-slate-900 mr-auto">{{ __('messages.listings') }}</h1>

        <form method="GET" action="{{ route('listings.index') }}" class="flex flex-wrap items-center gap-2">
            @if($search !== '')
            <input type="hidden" name="search" value="{{ $search }}">
            @endif
            <select name="category" class="h-10 min-w-44 border border-slate-300 rounded-lg px-3 text-sm text-slate-700">
                <option value="">Kategori</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected((int) $categoryId === (int) $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="h-10 px-4 bg-slate-700 text-white text-sm font-semibold rounded-lg hover:bg-slate-800 transition">Filtrele</button>
            @if($categoryId)
            <a href="{{ route('listings.index', array_filter(['search' => $search])) }}" class="h-10 px-4 inline-flex items-center border border-slate-300 text-sm font-semibold rounded-lg hover:bg-slate-50 transition">
                Sıfırla
            </a>
            @endif
        </form>
    </div>

    @auth
    @php
        $canSaveSearch = $search !== '' || !is_null($categoryId);
    @endphp
    <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 mb-6 flex flex-col sm:flex-row sm:items-center gap-3">
        <div class="mr-auto text-sm text-slate-600">
            Bu aramayı favorilere ekleyerek daha sonra hızlıca açabilirsin.
        </div>
        <form method="POST" action="{{ route('favorites.searches.store') }}">
            @csrf
            <input type="hidden" name="search" value="{{ $search }}">
            <input type="hidden" name="category_id" value="{{ $categoryId }}">
            <button type="submit" class="h-10 px-4 rounded-lg text-sm font-semibold {{ $isCurrentSearchSaved ? 'bg-emerald-100 text-emerald-700 cursor-default' : ($canSaveSearch ? 'bg-rose-500 text-white hover:bg-rose-600 transition' : 'bg-slate-200 text-slate-400 cursor-not-allowed') }}" @disabled($isCurrentSearchSaved || ! $canSaveSearch)>
                {{ $isCurrentSearchSaved ? 'Arama Favorilerde' : ($canSaveSearch ? 'Aramayı Favorilere Ekle' : 'Filtre seç') }}
            </button>
        </form>
        <a href="{{ route('favorites.index', ['tab' => 'searches']) }}" class="h-10 px-4 inline-flex items-center border border-slate-300 text-sm font-semibold rounded-lg hover:bg-white transition">
            Favori Aramalar
        </a>
    </div>
    @endauth

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($listings as $listing)
        @php
            $listingImage = $listing->getFirstMediaUrl('listing-images');
            $isFavorited = in_array($listing->id, $favoriteListingIds ?? [], true);
        @endphp
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition border border-slate-200">
            <div class="bg-gray-200 h-48 flex items-center justify-center relative">
                @if($listingImage)
                <img src="{{ $listingImage }}" alt="{{ $listing->title }}" class="w-full h-full object-cover">
                @else
                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                @endif

                <div class="absolute top-3 right-3">
                    @auth
                    <form method="POST" action="{{ route('favorites.listings.toggle', $listing) }}">
                        @csrf
                        <button type="submit" class="w-9 h-9 rounded-full grid place-items-center transition {{ $isFavorited ? 'bg-rose-500 text-white' : 'bg-white/95 text-slate-500 hover:text-rose-500' }}" aria-label="Favoriye ekle">
                            ♥
                        </button>
                    </form>
                    @else
                    <a href="{{ route('filament.partner.auth.login') }}" class="w-9 h-9 rounded-full bg-white/95 text-slate-500 hover:text-rose-500 grid place-items-center transition" aria-label="Giriş yap">
                        ♥
                    </a>
                    @endauth
                </div>
            </div>
            <div class="p-4">
                @if($listing->is_featured)
                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-1 rounded">Featured</span>
                @endif
                <h3 class="font-semibold text-gray-900 mt-2 truncate">{{ $listing->title }}</h3>
                <p class="text-green-600 font-bold text-lg mt-1">
                    @if($listing->price) {{ number_format($listing->price, 0) }} {{ $listing->currency }} @else Free @endif
                </p>
                <p class="text-xs text-slate-500 mt-1 truncate">{{ $listing->category?->name ?: 'Kategori yok' }}</p>
                <p class="text-gray-500 text-sm mt-1">{{ $listing->city }}, {{ $listing->country }}</p>
                <a href="{{ route('listings.show', $listing) }}" class="mt-3 block text-center bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">View</a>
            </div>
        </div>
        @empty
        <div class="md:col-span-2 lg:col-span-3 xl:col-span-4 border border-dashed border-slate-300 rounded-xl py-14 text-center text-slate-500">
            Bu filtreye uygun ilan bulunamadı.
        </div>
        @endforeach
    </div>
    <div class="mt-8">{{ $listings->links() }}</div>
</div>
@endsection
