@extends('layouts.app')
@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <h1 class="text-3xl font-bold">{{ $category->icon ?? '' }} {{ $category->name }}</h1>
        @if($category->description)<p class="text-gray-600 mt-2">{{ $category->description }}</p>@endif
    </div>
    @if($category->children->count())
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        @foreach($category->children as $child)
        <a href="{{ route('categories.show', $child) }}" class="bg-blue-50 rounded-lg p-4 text-center hover:bg-blue-100 transition">
            <h3 class="font-medium text-blue-800">{{ $child->name }}</h3>
        </a>
        @endforeach
    </div>
    @endif
    <h2 class="text-xl font-bold mb-4">Listings in {{ $category->name }}</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($listings as $listing)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4">
                <h3 class="font-semibold">{{ $listing->title }}</h3>
                <p class="text-green-600 font-bold">{{ $listing->price ? number_format($listing->price, 0).' '.$listing->currency : 'Free' }}</p>
                <a href="{{ route('listings.show', $listing) }}" class="mt-2 block text-blue-600 hover:underline">View →</a>
            </div>
        </div>
        @empty
        <p class="text-gray-500 col-span-3">No listings in this category yet.</p>
        @endforelse
    </div>
    <div class="mt-6">{{ $listings->links() }}</div>
</div>
@endsection
