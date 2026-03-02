@extends('layouts.app')
@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-gray-200 h-96 flex items-center justify-center">
                <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <div class="p-6">
                <div class="flex justify-between items-start">
                    <h1 class="text-2xl font-bold text-gray-900">{{ $listing->title }}</h1>
                    <span class="text-3xl font-bold text-green-600">
                        @if($listing->price) {{ number_format($listing->price, 0) }} {{ $listing->currency }} @else Free @endif
                    </span>
                </div>
                <p class="text-gray-500 mt-2">{{ $listing->city }}, {{ $listing->country }}</p>
                <p class="text-gray-500 text-sm">Posted {{ $listing->created_at->diffForHumans() }}</p>
                <div class="mt-4 border-t pt-4">
                    <h2 class="font-semibold text-lg mb-2">Description</h2>
                    <p class="text-gray-700">{{ $listing->description }}</p>
                </div>
                <div class="mt-6 bg-gray-50 rounded-lg p-4">
                    <h2 class="font-semibold text-lg mb-3">Contact Seller</h2>
                    @if($listing->contact_phone)
                    <p class="text-gray-700"><span class="font-medium">Phone:</span> {{ $listing->contact_phone }}</p>
                    @endif
                    @if($listing->contact_email)
                    <p class="text-gray-700"><span class="font-medium">Email:</span> {{ $listing->contact_email }}</p>
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
