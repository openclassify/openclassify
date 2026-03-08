<div class="flex flex-col min-h-[620px]" data-inbox-thread-panel data-selected-conversation-id="{{ $selectedConversation?->id ?? '' }}">
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
            <p class="text-3xl font-bold text-slate-900 truncate">{{ $activePartner?->name ?? 'User' }}</p>
            <p class="text-sm text-slate-500 truncate">{{ $activeListing?->title ?? 'Listing removed' }}</p>
        </div>
        @if($activePriceLabel)
        <div class="ml-auto text-3xl font-semibold text-slate-800 whitespace-nowrap">{{ $activePriceLabel }}</div>
        @endif
    </div>

    <div class="flex-1 px-6 py-6 bg-slate-100/60 overflow-y-auto max-h-[390px]" data-inbox-thread>
        @forelse($selectedConversation->messages as $message)
        @php $isMine = (int) $message->sender_id === (int) auth()->id(); @endphp
        <div class="mb-4 flex {{ $isMine ? 'justify-end' : 'justify-start' }}" data-message-id="{{ $message->id }}">
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
        <div class="h-full grid place-items-center text-slate-500 text-center px-8" data-inbox-empty>
            <div>
                <p class="font-semibold text-slate-700">No messages yet.</p>
                <p class="mt-1 text-sm">Use a quick reply or send the first message below.</p>
            </div>
        </div>
        @endforelse
    </div>

    <div class="px-4 py-3 border-t border-slate-200 bg-white">
        <div class="flex items-center gap-2 overflow-x-auto pb-2">
            @foreach($quickMessages as $quickMessage)
            <form method="POST" action="{{ route('conversations.messages.send', $selectedConversation) }}" class="shrink-0" data-inbox-send-form>
                @csrf
                <input type="hidden" name="message_filter" value="{{ $messageFilter }}">
                <input type="hidden" name="message" value="{{ $quickMessage }}">
                <button type="submit" class="inline-flex items-center h-11 px-5 rounded-full border border-rose-300 text-rose-600 font-semibold text-sm hover:bg-rose-50 transition">
                    {{ $quickMessage }}
                </button>
            </form>
            @endforeach
        </div>
        <form method="POST" action="{{ route('conversations.messages.send', $selectedConversation) }}" class="flex items-center gap-2 border-t border-slate-200 pt-3 mt-1" data-inbox-send-form>
            @csrf
            <input type="hidden" name="message_filter" value="{{ $messageFilter }}">
            <input type="text" name="message" value="{{ old('message') }}" placeholder="Write a message" maxlength="2000" class="h-12 flex-1 rounded-full border border-slate-300 px-5 text-sm focus:outline-none focus:ring-2 focus:ring-rose-300" required data-inbox-message-input>
            <button type="submit" class="h-12 w-12 rounded-full bg-black text-white grid place-items-center hover:bg-slate-800 transition" aria-label="Send" data-inbox-send-button>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h13m0 0l-5-5m5 5l-5 5"/>
                </svg>
            </button>
        </form>
        <p class="text-xs text-rose-600 mt-2 px-2 hidden" data-inbox-send-error></p>
    </div>
    @else
    <div class="h-full min-h-[620px] grid place-items-center px-8 text-center text-slate-500">
        <div>
            <p class="text-2xl font-semibold text-slate-700">Choose a conversation to start messaging.</p>
            <p class="mt-2 text-sm">Start a new chat from a listing detail page or continue an existing thread here.</p>
        </div>
    </div>
    @endif
</div>
