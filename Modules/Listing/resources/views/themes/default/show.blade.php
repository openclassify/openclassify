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
    $galleryImages = collect($gallery ?? []);
    $mainImage = $galleryImages->first();
    $breadcrumbs = collect($breadcrumbCategories ?? []);
@endphp
<div class="max-w-[1120px] mx-auto px-4 py-8">
    @if($breadcrumbs->isNotEmpty())
    <nav class="text-xs text-[var(--oc-muted)] mb-4 flex flex-wrap items-center gap-1">
        <a href="{{ route('listings.index') }}" class="oc-text-link">{{ __('site::messages.listings') }}</a>
        @foreach($breadcrumbs as $crumb)
        <span>/</span>
        <a href="{{ route('listings.index', ['category' => $crumb->id]) }}" class="oc-text-link">{{ $crumb->name }}</a>
        @endforeach
    </nav>
    @endif

    <div class="grid lg:grid-cols-[1.3fr,0.7fr] gap-8">
        <div>
            <div class="rounded-2xl border border-[var(--oc-border)] bg-[var(--oc-surface)] overflow-hidden aspect-[4/3]">
                @if($mainImage)
                @include('listing::partials.responsive-image', [
                    'image' => $mainImage['gallery'] ?? null,
                    'alt' => $displayTitle,
                    'class' => 'w-full h-full object-cover',
                    'loading' => 'eager',
                    'fetchpriority' => 'high',
                ])
                @else
                <div class="w-full h-full grid place-items-center text-[var(--oc-muted)] text-sm">{{ __('listing::messages.no_image') }}</div>
                @endif
            </div>

            @if($galleryImages->count() > 1)
            <div class="mt-3 grid grid-cols-5 gap-2">
                @foreach($galleryImages->skip(1)->take(5) as $image)
                <div class="rounded-lg border border-[var(--oc-border)] overflow-hidden aspect-square">
                    @include('listing::partials.responsive-image', [
                        'image' => $image['thumb'] ?? null,
                        'alt' => $displayTitle,
                        'class' => 'w-full h-full object-cover',
                    ])
                </div>
                @endforeach
            </div>
            @endif

            <div class="mt-8 border-t border-[var(--oc-border)] pt-6">
                <h2 class="text-lg font-semibold text-[var(--oc-text)] mb-2">{{ __('listing::messages.description') }}</h2>
                <p class="text-[var(--oc-muted)] leading-7 whitespace-pre-line">{{ $displayDescription }}</p>
            </div>

            @if(($listingVideos ?? collect())->isNotEmpty())
            <div class="mt-8 border-t border-[var(--oc-border)] pt-6">
                <h2 class="text-lg font-semibold text-[var(--oc-text)] mb-3">{{ __('listing::messages.videos') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($listingVideos as $video)
                    <div class="rounded-xl border border-[var(--oc-border)] p-3">
                        <video class="w-full rounded-lg bg-black" controls preload="metadata" src="{{ $video->playableUrl() }}"></video>
                        <p class="mt-2 text-sm font-medium text-[var(--oc-text)]">{{ $video->titleLabel() }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if(($presentableCustomFields ?? []) !== [])
            <div class="mt-8 border-t border-[var(--oc-border)] pt-6">
                <h2 class="text-lg font-semibold text-[var(--oc-text)] mb-3">{{ __('listing::messages.listing_details') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    @foreach($presentableCustomFields as $field)
                    <div class="rounded-lg border border-[var(--oc-border)] px-3 py-2">
                        <p class="text-xs uppercase tracking-wide text-[var(--oc-muted)]">{{ $field['label'] }}</p>
                        <p class="text-sm font-medium text-[var(--oc-text)] mt-1">{{ $field['value'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <div>
            <div class="rounded-2xl border border-[var(--oc-border)] p-5 sticky top-24">
                <p class="text-3xl font-semibold text-[var(--oc-text)]">
                    @if($hasPrice)
                        @if($priceValue > 0)
                            {{ number_format($priceValue, 0) }} {{ $listing->currency ?? 'USD' }}
                        @else
                            {{ __('listing::messages.free') }}
                        @endif
                    @else
                        {{ __('listing::messages.price_on_request') }}
                    @endif
                </p>
                <h1 class="mt-2 text-lg font-semibold text-[var(--oc-text)]">{{ $displayTitle }}</h1>
                <p class="mt-1 text-sm text-[var(--oc-muted)]">{{ $location !== '' ? $location : __('listing::messages.location_not_specified') }}</p>
                <p class="text-sm text-[var(--oc-muted)]">{{ __('listing::messages.posted_at', ['time' => $listing->created_at?->diffForHumans() ?? 'recently']) }}</p>

                <div class="mt-4 flex flex-wrap gap-2">
                    @auth
                    <form method="POST" action="{{ route('favorites.listings.toggle', $listing) }}">
                        @csrf
                        <button type="submit" class="oc-pill {{ $isListingFavorited ? 'is-active' : '' }}">
                            {{ $isListingFavorited ? '♥ '.__('listing::messages.saved') : '♡ '.__('listing::messages.save_listing') }}
                        </button>
                    </form>
                    @if($listing->user && (int) $listing->user->id !== (int) auth()->id())
                    <form method="POST" action="{{ route('favorites.sellers.toggle', $listing->user) }}">
                        @csrf
                        <button type="submit" class="oc-pill {{ $isSellerFavorited ? 'is-active' : '' }}">
                            {{ $isSellerFavorited ? __('listing::messages.seller_saved') : __('listing::messages.save_seller') }}
                        </button>
                    </form>
                    @endif
                    @else
                    <a href="{{ route('login') }}" class="oc-pill">{{ __('listing::messages.log_in_to_save') }}</a>
                    @endauth
                </div>

                <div class="mt-6 border-t border-[var(--oc-border)] pt-5">
                    <h2 class="text-base font-semibold text-[var(--oc-text)] mb-3">{{ __('listing::messages.contact_seller') }}</h2>
                    @if($listing->user)
                    <p class="text-sm text-[var(--oc-text)] mb-3"><span class="text-[var(--oc-muted)]">Name:</span> {{ $listing->user->name }}</p>
                    @endif

                    @auth
                        @if($listing->user && (int) $listing->user->id !== (int) auth()->id())
                            @if($detailConversation)
                            <a href="{{ route('panel.inbox.index', ['conversation' => $detailConversation->id]) }}" class="btn-primary w-full justify-center py-2.5 text-sm font-semibold">
                                {{ __('listing::messages.open_chat') }}
                            </a>
                            @else
                            <form method="POST" action="{{ route('conversations.start', $listing) }}">
                                @csrf
                                <button type="submit" class="btn-primary w-full justify-center py-2.5 text-sm font-semibold">
                                    {{ __('listing::messages.message_seller') }}
                                </button>
                            </form>
                            @endif
                        @endif
                    @else
                    <a href="{{ route('login') }}" class="btn-primary w-full justify-center py-2.5 text-sm font-semibold">
                        {{ __('listing::messages.log_in_to_contact_seller') }}
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    @if(($relatedListings ?? collect())->isNotEmpty())
    <div class="mt-12 border-t border-[var(--oc-border)] pt-8">
        <h2 class="text-lg font-semibold text-[var(--oc-text)] mb-4">{{ __('listing::messages.similar_listings') }}</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($relatedListings as $related)
            @php
                $relatedImage = $related->primaryImageData('card');
                $relatedPrice = $related->price ? number_format((float) $related->price, 0).' '.$related->currency : 'Free';
            @endphp
            <a href="{{ route('listings.show', $related) }}" class="rounded-xl border border-[var(--oc-border)] overflow-hidden block">
                <div class="h-32 bg-[var(--oc-bg)]">
                    @if($relatedImage)
                    @include('listing::partials.responsive-image', [
                        'image' => $relatedImage,
                        'alt' => $related->title,
                        'class' => 'w-full h-full object-cover',
                    ])
                    @endif
                </div>
                <div class="p-3">
                    <p class="text-sm font-semibold text-[var(--oc-text)]">{{ $relatedPrice }}</p>
                    <p class="text-xs text-[var(--oc-muted)] truncate mt-1">{{ $related->title }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
