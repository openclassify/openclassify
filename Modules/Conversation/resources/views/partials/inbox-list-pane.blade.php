<div class="border-b xl:border-b-0 xl:border-r border-slate-200">
    <div class="px-6 py-4 border-b border-slate-200">
        <p class="mb-2 text-sm font-semibold text-slate-600">Filters</p>
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('panel.inbox.index', ['message_filter' => 'all']) }}" class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold border {{ $messageFilter === 'all' ? 'border-rose-400 bg-rose-50 text-rose-600' : 'border-slate-300 text-slate-600 hover:bg-slate-100' }}">
                All
            </a>
            <a href="{{ route('panel.inbox.index', ['message_filter' => 'unread']) }}" class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold border {{ $messageFilter === 'unread' ? 'border-rose-400 bg-rose-50 text-rose-600' : 'border-slate-300 text-slate-600 hover:bg-slate-100' }}">
                Unread
            </a>
            <a href="{{ route('panel.inbox.index', ['message_filter' => 'important']) }}" class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold border {{ $messageFilter === 'important' ? 'border-rose-400 bg-rose-50 text-rose-600' : 'border-slate-300 text-slate-600 hover:bg-slate-100' }}">
                Important
            </a>
        </div>
    </div>
    <div class="max-h-[480px] overflow-y-auto divide-y divide-slate-200">
        @forelse($conversations as $conversation)
        @php
            $conversationListing = $conversation->listing;
            $partner = (int) $conversation->buyer_id === (int) auth()->id() ? $conversation->seller : $conversation->buyer;
            $isSelected = $selectedConversation && (int) $selectedConversation->id === (int) $conversation->id;
            $conversationImage = $conversationListing?->primaryImageData('thumb');
            $lastMessage = trim((string) ($conversation->lastMessage?->body ?? ''));
        @endphp
        <a href="{{ route('panel.inbox.index', ['message_filter' => $messageFilter, 'conversation' => $conversation->id]) }}" class="block px-6 py-4 transition {{ $isSelected ? 'bg-rose-50' : 'hover:bg-slate-50' }}">
            <div class="flex gap-3">
                <div class="w-14 h-14 rounded-xl bg-slate-100 border border-slate-200 overflow-hidden shrink-0">
                    @if($conversationImage)
                    @include('listing::partials.responsive-image', [
                        'image' => $conversationImage,
                        'alt' => $conversationListing?->title,
                        'class' => 'w-full h-full object-cover',
                    ])
                    @else
                    <div class="w-full h-full grid place-items-center text-slate-400 text-xs">Listing</div>
                    @endif
                </div>
                <div class="min-w-0 flex-1">
                    <div class="flex items-start gap-2">
                        <p class="font-semibold text-2xl text-slate-900 truncate">{{ $partner?->name ?? 'User' }}</p>
                        <p class="text-xs text-slate-500 whitespace-nowrap ml-auto">{{ $conversation->last_message_at?->format('d.m.Y') }}</p>
                    </div>
                    <p class="text-sm text-slate-500 truncate mt-1">{{ $conversationListing?->title ?? 'Listing removed' }}</p>
                    <p class="text-sm {{ $conversation->unread_count > 0 ? 'text-slate-900 font-semibold' : 'text-slate-500' }} truncate mt-1">
                        {{ $lastMessage !== '' ? $lastMessage : 'No messages yet' }}
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
            No conversations yet.
        </div>
        @endforelse
    </div>
</div>
