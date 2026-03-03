@extends('app::layouts.app')
@section('content')
<div class="bg-gradient-to-br from-blue-600 to-blue-800 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ __('messages.find_what_you_need') }}</h1>
        <p class="text-blue-200 text-lg mb-8">{{ __('messages.hero_subtitle') }}</p>
        <form action="{{ route('listings.index') }}" method="GET" class="max-w-2xl mx-auto">
            <div class="flex bg-white rounded-xl overflow-hidden shadow-lg">
                <input type="text" name="search" placeholder="{{ __('messages.search_placeholder') }}" class="flex-1 px-5 py-4 text-gray-800 focus:outline-none text-lg">
                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-4 font-semibold transition">{{ __('messages.search') }}</button>
            </div>
        </form>
    </div>
</div>
<div class="bg-white border-b py-4">
    <div class="container mx-auto px-4">
        <div class="flex justify-center space-x-8 text-center text-sm text-gray-600">
            <div><span class="font-bold text-blue-600 text-lg">{{ $listingCount ?? 0 }}</span><br>Active Listings</div>
            <div><span class="font-bold text-blue-600 text-lg">{{ $categoryCount ?? 0 }}</span><br>Categories</div>
            <div><span class="font-bold text-blue-600 text-lg">{{ $userCount ?? 0 }}</span><br>Users</div>
        </div>
    </div>
</div>
<div class="container mx-auto px-4 py-12">
    <h2 class="text-2xl font-bold mb-6">{{ __('messages.browse_categories') }}</h2>
    <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-8 gap-4">
        @foreach($categories as $category)
        <a href="{{ route('categories.show', $category) }}" class="bg-white rounded-xl p-4 text-center shadow-sm hover:shadow-md transition hover:-translate-y-1 transform">
            <div class="text-3xl mb-2">{{ $category->icon ?? '📦' }}</div>
            <div class="text-xs font-medium text-gray-700 truncate">{{ $category->name }}</div>
        </a>
        @endforeach
    </div>
    <div class="text-center mt-6">
        <a href="{{ route('categories.index') }}" class="text-blue-600 hover:underline font-medium">View all categories →</a>
    </div>
</div>
@if($featuredListings->count())
<div class="bg-gray-100 py-12">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold mb-6">⭐ Featured Listings</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredListings as $listing)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="bg-gradient-to-br from-blue-100 to-blue-200 h-48 flex items-center justify-center">
                    <svg class="w-16 h-16 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-gray-900 truncate">{{ $listing->title }}</h3>
                    <p class="text-green-600 font-bold text-lg">{{ $listing->price ? number_format($listing->price, 0).' '.$listing->currency : 'Free' }}</p>
                    <p class="text-gray-500 text-sm">{{ $listing->city }}</p>
                    <a href="{{ route('listings.show', $listing) }}" class="mt-3 block text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition text-sm">View Details</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
<div class="container mx-auto px-4 py-12">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">{{ __('messages.recent_listings') }}</h2>
        <a href="{{ route('listings.index') }}" class="text-blue-600 hover:underline font-medium">View all →</a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($recentListings as $listing)
        <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition border border-gray-100">
            <div class="bg-gray-100 h-44 flex items-center justify-center">
                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <div class="p-4">
                <h3 class="font-medium text-gray-900 truncate text-sm">{{ $listing->title }}</h3>
                <p class="text-green-600 font-bold">{{ $listing->price ? number_format($listing->price, 0).' '.$listing->currency : 'Free' }}</p>
                <div class="flex justify-between items-center mt-2">
                    <p class="text-gray-400 text-xs">{{ $listing->city }}</p>
                    <p class="text-gray-400 text-xs">{{ $listing->created_at->diffForHumans() }}</p>
                </div>
                <a href="{{ route('listings.show', $listing) }}" class="mt-2 block text-center border border-blue-600 text-blue-600 py-1.5 rounded-lg hover:bg-blue-600 hover:text-white transition text-sm">View</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="bg-blue-600 text-white py-12 mt-8">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">{{ __('messages.sell_something') }}</h2>
        <p class="text-blue-200 mb-6">Post your first listing for free!</p>
        @auth
        <a href="{{ route('filament.partner.resources.listings.create', ['tenant' => auth()->id()]) }}" class="bg-orange-500 text-white px-8 py-3 rounded-xl hover:bg-orange-600 transition font-semibold text-lg">Post a Free Ad</a>
        @else
        <a href="{{ route('register') }}" class="bg-white text-blue-600 px-8 py-3 rounded-xl hover:bg-gray-100 transition font-semibold text-lg">Get Started Free</a>
        @endauth
    </div>
</div>
@endsection
