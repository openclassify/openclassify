@php
    $activeMenu = $activeMenu ?? '';
    $activeFavoritesTab = $activeFavoritesTab ?? '';
@endphp

<aside class="bg-white border border-slate-200 rounded-xl overflow-hidden">
    <a href="{{ route('panel.listings.create') }}" class="block px-5 py-4 text-base {{ $activeMenu === 'create' ? 'bg-rose-50 text-rose-600 font-semibold' : 'text-slate-700 hover:bg-slate-50' }}">
        İlan Ver
    </a>
    <a href="{{ route('panel.listings.index') }}" class="block px-5 py-4 border-t border-slate-200 text-base {{ $activeMenu === 'listings' ? 'bg-rose-50 text-rose-600 font-semibold' : 'text-slate-700 hover:bg-slate-50' }}">
        İlanlarım
    </a>
    <a href="{{ route('favorites.index', ['tab' => 'listings']) }}" class="block px-5 py-4 border-t border-slate-200 text-base {{ $activeMenu === 'favorites' ? 'bg-rose-50 text-rose-600 font-semibold' : 'text-slate-700 hover:bg-slate-50' }}">
        Favorilerim
    </a>
    <a href="{{ route('favorites.index', ['tab' => 'listings']) }}" class="block px-9 py-3 border-t border-slate-100 text-sm {{ $activeFavoritesTab === 'listings' ? 'bg-rose-50 text-rose-600 font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
        Favori İlanlar
    </a>
    <a href="{{ route('favorites.index', ['tab' => 'searches']) }}" class="block px-9 py-3 border-t border-slate-100 text-sm {{ $activeFavoritesTab === 'searches' ? 'bg-rose-50 text-rose-600 font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
        Favori Aramalar
    </a>
    <a href="{{ route('favorites.index', ['tab' => 'sellers']) }}" class="block px-9 py-3 border-t border-slate-100 text-sm {{ $activeFavoritesTab === 'sellers' ? 'bg-rose-50 text-rose-600 font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
        Favori Satıcılar
    </a>
    <a href="{{ route('panel.inbox.index') }}" class="block px-5 py-4 border-t border-slate-200 text-base {{ $activeMenu === 'inbox' ? 'bg-rose-50 text-rose-600 font-semibold' : 'text-slate-700 hover:bg-slate-50' }}">
        Gelen Kutusu
    </a>
</aside>
