@extends('app::layouts.app')
@section('content')
@php
    $title = trim((string) ($listing->title ?? ''));
    $displayTitle = ($title !== '' && preg_match('/[\pL\pN]/u', $title)) ? $title : 'Untitled listing';

    $city = trim((string) ($listing->city ?? ''));
    $country = trim((string) ($listing->country ?? ''));
    $location = implode(', ', array_filter([$city, $country], fn ($value) => $value !== ''));

    $description = trim((string) ($listing->description ?? ''));
    $displayDescription = ($description !== '' && preg_match('/[\pL\pN]/u', $description))
        ? $description
        : 'No description provided.';

    $hasPrice = !is_null($listing->price);
    $priceValue = $hasPrice ? (float) $listing->price : null;
@endphp
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-gray-200 h-96 flex items-center justify-center">
                <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <div class="p-6">
                <div class="flex justify-between items-start">
                    <h1 class="text-2xl font-bold text-gray-900">{{ $displayTitle }}</h1>
                    <span class="text-3xl font-bold text-green-600">
                        @if($hasPrice)
                            @if($priceValue > 0)
                                {{ number_format($priceValue, 0) }} {{ $listing->currency ?? 'USD' }}
                            @else
                                Free
                            @endif
                        @else
                            Price on request
                        @endif
                    </span>
                </div>
                <div class="mt-3 flex flex-wrap items-center gap-2">
                    @auth
                    <form method="POST" action="{{ route('favorites.listings.toggle', $listing) }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold transition {{ $isListingFavorited ? 'bg-rose-100 text-rose-700' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                            {{ $isListingFavorited ? '♥ Saved' : '♡ Save listing' }}
                        </button>
                    </form>
                    @if($listing->user && (int) $listing->user->id !== (int) auth()->id())
                    <form method="POST" action="{{ route('favorites.sellers.toggle', $listing->user) }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold transition {{ $isSellerFavorited ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                            {{ $isSellerFavorited ? 'Seller saved' : 'Save seller' }}
                        </button>
                    </form>
                        @if($existingConversationId)
                        <a href="{{ route('panel.inbox.index', ['conversation' => $existingConversationId]) }}" class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-rose-100 text-rose-700 hover:bg-rose-200 transition">
                            Open chat
                        </a>
                        @else
                        <form method="POST" action="{{ route('conversations.start', $listing) }}">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-rose-500 text-white hover:bg-rose-600 transition">
                                Message seller
                            </button>
                        </form>
                        @endif
                    @endif
                    @else
                    <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-slate-100 text-slate-700 hover:bg-slate-200 transition">
                        Log in to save
                    </a>
                    @endauth
                </div>
                <p class="text-gray-500 mt-2">{{ $location !== '' ? $location : 'Location not specified' }}</p>
                <p class="text-gray-500 text-sm">Posted {{ $listing->created_at?->diffForHumans() ?? 'recently' }}</p>
                <div class="mt-4 border-t pt-4">
                    <h2 class="font-semibold text-lg mb-2">Description</h2>
                    <p class="text-gray-700">{{ $displayDescription }}</p>
                </div>
                @if(($listingVideos ?? collect())->isNotEmpty())
                <div class="mt-6 border-t pt-4">
                    <h2 class="font-semibold text-lg mb-3">Videos</h2>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        @foreach($listingVideos as $video)
                        <div class="rounded-xl border border-slate-200 bg-slate-50 p-3">
                            <video class="w-full rounded-lg bg-black" controls preload="metadata" src="{{ $video->playableUrl() }}"></video>
                            <p class="mt-2 text-sm font-semibold text-slate-800">{{ $video->titleLabel() }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                @if(($presentableCustomFields ?? []) !== [])
                <div class="mt-6 border-t pt-4">
                    <h2 class="font-semibold text-lg mb-3">Listing details</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach($presentableCustomFields as $field)
                        <div class="rounded-lg border border-slate-200 bg-slate-50 px-3 py-2">
                            <p class="text-xs uppercase tracking-wide text-slate-500">{{ $field['label'] }}</p>
                            <p class="text-sm font-medium text-slate-800 mt-1">{{ $field['value'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                <div class="mt-6 bg-gray-50 rounded-lg p-4">
                    <h2 class="font-semibold text-lg mb-3">Contact Seller</h2>
                    @if($listing->user)
                    <p class="text-gray-700"><span class="font-medium">Name:</span> {{ $listing->user->name }}</p>
                    @endif
                    @if($listing->contact_phone)
                    <p class="text-gray-700"><span class="font-medium">Phone:</span> {{ $listing->contact_phone }}</p>
                    @endif
                    @if($listing->contact_email)
                    <p class="text-gray-700"><span class="font-medium">Email:</span> {{ $listing->contact_email }}</p>
                    @endif
                    @if(!$listing->contact_phone && !$listing->contact_email)
                    <p class="text-gray-700">No contact details provided.</p>
                    @endif
                </div>
                <div class="mt-6">
                    <a href="{{ route('listings.index') }}" class="text-blue-600 hover:underline">← Back to listings</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
