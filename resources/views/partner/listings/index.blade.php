@extends('layouts.app')
@section('title', 'My Listings')
@section('content')
@php($partnerCreateRoute = route('filament.partner.resources.listings.create', ['tenant' => auth()->id()]))
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">My Listings</h1>
        <a href="{{ $partnerCreateRoute }}" class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition">+ New Listing</a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($listings as $listing)
        <div class="bg-white rounded-xl shadow-sm overflow-hidden border">
            <div class="p-4">
                <div class="flex justify-between items-start">
                    <h3 class="font-semibold text-gray-900 truncate">{{ $listing->title }}</h3>
                    <span class="ml-2 text-xs px-2 py-1 rounded {{ $listing->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">{{ ucfirst($listing->status) }}</span>
                </div>
                <p class="text-green-600 font-bold mt-1">{{ $listing->price ? number_format($listing->price, 0).' '.$listing->currency : 'Free' }}</p>
                <p class="text-gray-400 text-xs mt-1">{{ $listing->created_at->format('M d, Y') }}</p>
                <a href="{{ route('listings.show', $listing) }}" class="mt-3 block text-center border border-blue-600 text-blue-600 py-1.5 rounded hover:bg-blue-600 hover:text-white transition text-sm">View</a>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-12 text-gray-500">
            <p>No listings yet.</p>
            <a href="{{ $partnerCreateRoute }}" class="mt-3 inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">Post Your First Listing</a>
        </div>
        @endforelse
    </div>
    <div class="mt-6">{{ $listings->links() }}</div>
</div>
@endsection
