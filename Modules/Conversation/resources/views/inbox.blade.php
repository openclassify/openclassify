@extends('app::layouts.app')

@section('title', 'Gelen Kutusu')

@section('content')
<div class="max-w-[1320px] mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-[220px,1fr] gap-4">
        @include('panel.partials.sidebar', ['activeMenu' => 'inbox'])

        <section class="bg-white border border-slate-200 rounded-xl p-0 overflow-hidden">
            <div class="grid grid-cols-1 xl:grid-cols-[420px,1fr] min-h-[620px]">
                <div class="border-b xl:border-b-0 xl:border-r border-slate-200">
                    <div class="px-6 py-5 border-b border-slate-200 flex items-center justify-between gap-3">
                        <h1 class="text-3xl font-bold text-slate-900">Gelen Kutusu</h1>
                        <svg class="w-6 h-6 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m1.6-5.05a7.25 7.25 0 11-14.5 0 7.25 7.25 0 0114.5 0z"/>
                        </svg>
                    </div>
                    <div class="px-6 py-4 border-b border-slate-200">
                        <p class="text-sm font-semibold text-slate-600 mb-2">Hızlı Filtreler</p>
                        <div class="flex flex-wrap items-center gap-2">
                            <a href="{{ route('panel.inbox.index', ['message_filter' => 'all']) }}" class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold border {{ $messageFilter === 'all' ? 'border-rose-400 bg-rose-50 text-rose-600' : 'border-slate-300 text-slate-600 hover:bg-slate-100' }}">
                                Hepsi
                            </a>
                            <a href="{{ route('panel.inbox.index', ['message_filter' => 'unread']) }}" class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold border {{ $messageFilter === 'unread' ? 'border-rose-400 bg-rose-50 text-rose-600' : 'border-slate-300 text-slate-600 hover:bg-slate-100' }}">
                                Okunmamış
                            </a>
                            <a href="{{ route('panel.inbox.index', ['message_filter' => 'important']) }}" class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold border {{ $messageFilter === 'important' ? 'border-rose-400 bg-rose-50 text-rose-600' : 'border-slate-300 text-slate-600 hover:bg-slate-100' }}">
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
                        <a href="{{ route('panel.inbox.index', ['message_filter' => $messageFilter, 'conversation' => $conversation->id]) }}" class="block px-6 py-4 transition {{ $isSelected ? 'bg-rose-50' : 'hover:bg-slate-50' }}">
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
                            <input type="hidden" name="message_filter" value="{{ $messageFilter }}">
                            <input type="text" name="message" value="{{ old('message') }}" placeholder="Bir mesaj yaz" maxlength="2000" class="h-12 flex-1 rounded-full border border-slate-300 px-5 text-sm focus:outline-none focus:ring-2 focus:ring-rose-300" required>
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
                            <p class="mt-2 text-sm">İlan detayından veya ilan kartlarından yeni sohbet başlatabilirsin.</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
