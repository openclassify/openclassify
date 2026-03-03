@extends('layouts.app')
@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">{{ __('messages.listings') }}</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($listings as $listing)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
            <div class="bg-gray-200 h-48 flex items-center justify-center">
                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <div class="p-4">
                @if($listing->is_featured)
                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-1 rounded">Featured</span>
                @endif
                <h3 class="font-semibold text-gray-900 mt-2 truncate">{{ $listing->title }}</h3>
                <p class="text-green-600 font-bold text-lg mt-1">
                    @if($listing->price) {{ number_format($listing->price, 0) }} {{ $listing->currency }} @else Free @endif
                </p>
                <p class="text-gray-500 text-sm mt-1">{{ $listing->city }}, {{ $listing->country }}</p>
                <a href="{{ route('listings.show', $listing) }}" class="mt-3 block text-center bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">View</a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-8">{{ $listings->links() }}</div>
</div>
@endsection
