@extends('app::layouts.app')

@section('title', 'Favoriler')

@section('content')
<div class="max-w-[1320px] mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-[220px,1fr] gap-4">
        @include('panel.partials.sidebar', ['activeMenu' => 'favorites', 'activeFavoritesTab' => $activeTab])

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
                    'message_filter' => $messageFilter,
                ], fn ($value) => !is_null($value) && $value !== '');
            @endphp
            <div class="border-b-2 border-blue-900 px-4 py-3 flex flex-wrap items-center gap-3">
                <h1 class="text-3xl font-bold text-slate-800 mr-auto">Favori Listem</h1>
                <div class="inline-flex border border-slate-300 overflow-hidden">
                    <a href="{{ route('favorites.index', array_merge($listingTabQuery, ['status' => 'all'])) }}" class="px-5 py-2 text-sm font-semibold {{ $statusFilter === 'all' ? 'bg-slate-700 text-white' : 'bg-white text-slate-700 hover:bg-slate-100' }}">
                        Tümü
                    </a>
                    <a href="{{ route('favorites.index', array_merge($listingTabQuery, ['status' => 'active'])) }}" class="px-5 py-2 text-sm font-semibold border-l border-slate-300 {{ $statusFilter === 'active' ? 'bg-slate-700 text-white' : 'bg-white text-slate-700 hover:bg-slate-100' }}">
                        Yayında
                    </a>
                </div>
                <form method="GET" action="{{ route('favorites.index') }}" class="flex items-center gap-2">
                    <input type="hidden" name="tab" value="listings">
                    <input type="hidden" name="status" value="{{ $statusFilter }}">
                    <input type="hidden" name="message_filter" value="{{ $messageFilter }}">
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
                <table class="w-full min-w-[860px]">
                    <thead>
                        <tr class="bg-slate-50 text-slate-700 text-sm">
                            <th class="text-left px-4 py-3 w-[58%]">İlan Başlığı</th>
                            <th class="text-left px-4 py-3 w-[16%]">Fiyat</th>
                            <th class="text-left px-4 py-3 w-[14%]">Mesajlaşma</th>
                            <th class="text-right px-4 py-3 w-[12%]"></th>
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
                            $conversationId = $buyerConversationListingMap[$listing->id] ?? null;
                            $isOwnListing = (int) $listing->user_id === (int) auth()->id();
                            $canMessageListing = !is_null($listing->user_id) && ! $isOwnListing;
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
                            <td class="px-4 py-4">
                                @if($canMessageListing)
                                    @if($conversationId)
                                    <a href="{{ route('panel.inbox.index', ['conversation' => $conversationId]) }}" class="inline-flex items-center h-10 px-4 border border-rose-300 text-rose-600 text-sm font-semibold rounded-full hover:bg-rose-50 transition">
                                        Sohbete Git
                                    </a>
                                    @else
                                    <form method="POST" action="{{ route('conversations.start', $listing) }}">
                                        @csrf
                                        <input type="hidden" name="status" value="{{ $statusFilter }}">
                                        @if($selectedCategoryId)
                                        <input type="hidden" name="category" value="{{ $selectedCategoryId }}">
                                        @endif
                                        <input type="hidden" name="message_filter" value="{{ $messageFilter }}">
                                        <button type="submit" class="inline-flex items-center h-10 px-4 bg-rose-500 text-white text-sm font-semibold rounded-full hover:bg-rose-600 transition">
                                            Mesaj Gönder
                                        </button>
                                    </form>
                                    @endif
                                @else
                                <span class="text-xs text-slate-400">{{ $isOwnListing ? 'Kendi ilanın' : 'Satıcı bilgisi yok' }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-right">
                                <form method="POST" action="{{ route('favorites.listings.toggle', $listing) }}">
                                    @csrf
                                    <button type="submit" class="text-sm font-semibold text-rose-500 hover:text-rose-600 transition">Kaldır</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr class="border-t border-slate-200">
                            <td colspan="4" class="px-4 py-10 text-center text-slate-500">
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

            <div class="border-t border-slate-200 bg-slate-50 p-4 sm:p-5">
                <div class="border border-slate-200 bg-white rounded-2xl overflow-hidden shadow-sm">
                    <div class="grid grid-cols-1 xl:grid-cols-[420px,1fr] min-h-[620px]">
                        <div class="border-b xl:border-b-0 xl:border-r border-slate-200">
                            <div class="px-6 py-5 border-b border-slate-200 flex items-center justify-between gap-3">
                                <h2 class="text-3xl font-bold text-slate-900">Gelen Kutusu</h2>
                                <svg class="w-6 h-6 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m1.6-5.05a7.25 7.25 0 11-14.5 0 7.25 7.25 0 0114.5 0z"/>
                                </svg>
                            </div>
                            <div class="px-6 py-4 border-b border-slate-200">
                                <p class="text-sm font-semibold text-slate-600 mb-2">Hızlı Filtreler</p>
                                <div class="flex flex-wrap items-center gap-2">
                                    <a href="{{ route('favorites.index', array_merge($listingTabQuery, ['message_filter' => 'all'])) }}" class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold border {{ $messageFilter === 'all' ? 'border-rose-400 bg-rose-50 text-rose-600' : 'border-slate-300 text-slate-600 hover:bg-slate-100' }}">
                                        Hepsi
                                    </a>
                                    <a href="{{ route('favorites.index', array_merge($listingTabQuery, ['message_filter' => 'unread'])) }}" class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold border {{ $messageFilter === 'unread' ? 'border-rose-400 bg-rose-50 text-rose-600' : 'border-slate-300 text-slate-600 hover:bg-slate-100' }}">
                                        Okunmamış
                                    </a>
                                    <a href="{{ route('favorites.index', array_merge($listingTabQuery, ['message_filter' => 'important'])) }}" class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold border {{ $messageFilter === 'important' ? 'border-rose-400 bg-rose-50 text-rose-600' : 'border-slate-300 text-slate-600 hover:bg-slate-100' }}">
                                        Önemli
                                    </a>
                                </div>
                            </div>
                            <div class="max-h-[480px] overflow-y-auto divide-y divide-slate-200">
                                @forelse($conversations as $conversation)
                                @php
                                    $conversationListing = $conversation->listing;
                                    $partner = (int) $conversation->buyer_id === (int) auth()->id() ? $conversation->seller : $conversation->buyer;
                                    $isSelected = $selectedConversation && (int) $selectedConversation->id === (int) $conversation->id;
                                    $conversationImage = $conversationListing?->getFirstMediaUrl('listing-images');
                                    $lastMessage = trim((string) ($conversation->lastMessage?->body ?? ''));
                                @endphp
                                <a href="{{ route('favorites.index', array_merge($listingTabQuery, ['conversation' => $conversation->id])) }}" class="block px-6 py-4 transition {{ $isSelected ? 'bg-rose-50' : 'hover:bg-slate-50' }}">
                                    <div class="flex gap-3">
                                        <div class="w-14 h-14 rounded-xl bg-slate-100 border border-slate-200 overflow-hidden shrink-0">
                                            @if($conversationImage)
                                            <img src="{{ $conversationImage }}" alt="{{ $conversationListing?->title }}" class="w-full h-full object-cover">
                                            @else
                                            <div class="w-full h-full grid place-items-center text-slate-400 text-xs">İlan</div>
                                            @endif
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <div class="flex items-start gap-2">
                                                <p class="font-semibold text-2xl text-slate-900 truncate">{{ $partner?->name ?? 'Kullanıcı' }}</p>
                                                <p class="text-xs text-slate-500 whitespace-nowrap ml-auto">{{ $conversation->last_message_at?->format('d.m.Y') }}</p>
                                            </div>
                                            <p class="text-sm text-slate-500 truncate mt-1">{{ $conversationListing?->title ?? 'İlan silinmiş' }}</p>
                                            <p class="text-sm {{ $conversation->unread_count > 0 ? 'text-slate-900 font-semibold' : 'text-slate-500' }} truncate mt-1">
                                                {{ $lastMessage !== '' ? $lastMessage : 'Henüz mesaj yok' }}
                                            </p>
                                        </div>
                                        @if($conversation->unread_count > 0)
                                        <span class="inline-flex items-center justify-center min-w-6 h-6 px-2 rounded-full bg-rose-500 text-white text-xs font-semibold">
                                            {{ $conversation->unread_count }}
                                        </span>
                                        @endif
                                    </div>
                                </a>
                                @empty
                                <div class="px-6 py-16 text-center text-slate-500">
                                    Henüz bir sohbetin yok.
                                </div>
                                @endforelse
                            </div>
                        </div>

                        <div class="flex flex-col min-h-[620px]">
                            @if($selectedConversation)
                            @php
                                $activeListing = $selectedConversation->listing;
                                $activePartner = (int) $selectedConversation->buyer_id === (int) auth()->id()
                                    ? $selectedConversation->seller
                                    : $selectedConversation->buyer;
                                $activePriceLabel = $activeListing && !is_null($activeListing->price)
                                    ? number_format((float) $activeListing->price, 0).' '.($activeListing->currency ?? 'TL')
                                    : null;
                            @endphp
                            <div class="h-24 px-6 border-b border-slate-200 flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-slate-600 text-white grid place-items-center font-semibold text-lg">
                                    {{ strtoupper(substr((string) ($activePartner?->name ?? 'K'), 0, 1)) }}
                                </div>
                                <div class="min-w-0">
                                    <p class="text-3xl font-bold text-slate-900 truncate">{{ $activePartner?->name ?? 'Kullanıcı' }}</p>
                                    <p class="text-sm text-slate-500 truncate">{{ $activeListing?->title ?? 'İlan silinmiş' }}</p>
                                </div>
                                @if($activePriceLabel)
                                <div class="ml-auto text-3xl font-semibold text-slate-800 whitespace-nowrap">{{ $activePriceLabel }}</div>
                                @endif
                            </div>

                            <div class="flex-1 px-6 py-6 bg-slate-100/60 overflow-y-auto max-h-[390px]">
                                @forelse($selectedConversation->messages as $message)
                                @php $isMine = (int) $message->sender_id === (int) auth()->id(); @endphp
                                <div class="mb-4 flex {{ $isMine ? 'justify-end' : 'justify-start' }}">
                                    <div class="max-w-[80%]">
                                        <div class="{{ $isMine ? 'bg-amber-100 text-slate-900' : 'bg-white text-slate-900 border border-slate-200' }} rounded-2xl px-4 py-2 text-base shadow-sm">
                                            {{ $message->body }}
                                        </div>
                                        <p class="text-xs text-slate-500 mt-1 {{ $isMine ? 'text-right' : 'text-left' }}">
                                            {{ $message->created_at?->format('H:i') }}
                                        </p>
                                    </div>
                                </div>
                                @empty
                                <div class="h-full grid place-items-center text-slate-500 text-center px-8">
                                    <div>
                                        <p class="font-semibold text-slate-700">Henüz mesaj yok.</p>
                                        <p class="text-sm mt-1">Aşağıdaki hazır metinlerden birini seçebilir veya yeni mesaj yazabilirsin.</p>
                                    </div>
                                </div>
                                @endforelse
                            </div>

                            <div class="px-4 py-3 border-t border-slate-200 bg-white">
                                <div class="flex items-center gap-2 overflow-x-auto pb-2">
                                    @foreach($quickMessages as $quickMessage)
                                    <form method="POST" action="{{ route('conversations.messages.send', $selectedConversation) }}" class="shrink-0">
                                        @csrf
                                        <input type="hidden" name="status" value="{{ $statusFilter }}">
                                        @if($selectedCategoryId)
                                        <input type="hidden" name="category" value="{{ $selectedCategoryId }}">
                                        @endif
                                        <input type="hidden" name="message_filter" value="{{ $messageFilter }}">
                                        <input type="hidden" name="message" value="{{ $quickMessage }}">
                                        <button type="submit" class="inline-flex items-center h-11 px-5 rounded-full border border-rose-300 text-rose-600 font-semibold text-sm hover:bg-rose-50 transition">
                                            {{ $quickMessage }}
                                        </button>
                                    </form>
                                    @endforeach
                                </div>
                                <form method="POST" action="{{ route('conversations.messages.send', $selectedConversation) }}" class="flex items-center gap-2 border-t border-slate-200 pt-3 mt-1">
                                    @csrf
                                    <input type="hidden" name="status" value="{{ $statusFilter }}">
                                    @if($selectedCategoryId)
                                    <input type="hidden" name="category" value="{{ $selectedCategoryId }}">
                                    @endif
                                    <input type="hidden" name="message_filter" value="{{ $messageFilter }}">
                                    <input
                                        type="text"
                                        name="message"
                                        value="{{ old('message') }}"
                                        placeholder="Bir mesaj yaz"
                                        maxlength="2000"
                                        class="h-12 flex-1 rounded-full border border-slate-300 px-5 text-sm focus:outline-none focus:ring-2 focus:ring-rose-300"
                                        required
                                    >
                                    <button type="submit" class="h-12 w-12 rounded-full bg-black text-white grid place-items-center hover:bg-slate-800 transition" aria-label="Gönder">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h13m0 0l-5-5m5 5l-5 5"/>
                                        </svg>
                                    </button>
                                </form>
                                @error('message')
                                <p class="text-xs text-rose-600 mt-2 px-2">{{ $message }}</p>
                                @enderror
                            </div>
                            @else
                            <div class="h-full min-h-[620px] grid place-items-center px-8 text-center text-slate-500">
                                <div>
                                    <p class="text-2xl font-semibold text-slate-700">Mesajlaşma için bir sohbet seç.</p>
                                    <p class="mt-2 text-sm">İlan detayından veya favori ilan satırındaki "Mesaj Gönder" butonundan yeni sohbet başlatabilirsin.</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
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
