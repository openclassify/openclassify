@extends('app::layouts.app')
@section('title', 'Dashboard')
@section('content')
@php($partnerCreateRoute = route('filament.partner.resources.listings.create', ['tenant' => auth()->id()]))
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">My Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="text-gray-500 text-sm font-medium">Total Listings</div>
            <div class="text-3xl font-bold text-blue-600 mt-1">{{ $stats['total'] }}</div>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="text-gray-500 text-sm font-medium">Active Listings</div>
            <div class="text-3xl font-bold text-green-600 mt-1">{{ $stats['active'] }}</div>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="text-gray-500 text-sm font-medium">Quick Actions</div>
            <a href="{{ $partnerCreateRoute }}" class="mt-2 block text-center bg-orange-500 text-white py-2 rounded-lg hover:bg-orange-600 transition text-sm">+ Post New Listing</a>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b flex justify-between items-center">
            <h2 class="font-semibold text-gray-900">My Listings</h2>
            <a href="{{ route('partner.listings.index') }}" class="text-blue-600 text-sm hover:underline">View all</a>
        </div>
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">Title</th>
                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">Price</th>
                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($myListings as $listing)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-900">{{ \Illuminate\Support\Str::limit($listing->title, 40) }}</td>
                    <td class="px-6 py-4 text-green-600 font-medium">{{ $listing->price ? number_format($listing->price, 0).' '.$listing->currency : 'Free' }}</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $listing->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst($listing->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-500 text-sm">{{ $listing->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('listings.show', $listing) }}" class="text-blue-600 hover:underline text-sm">View</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-8 text-center text-gray-500">No listings yet. <a href="{{ $partnerCreateRoute }}" class="text-blue-600 hover:underline">Post your first listing!</a></td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4">{{ $myListings->links() }}</div>
    </div>
</div>
@endsection
