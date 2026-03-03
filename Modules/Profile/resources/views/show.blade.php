@extends('app::layouts.app')
@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center space-x-4 mb-6">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                <span class="text-2xl font-bold text-blue-600">{{ substr(auth()->user()->name, 0, 1) }}</span>
            </div>
            <div>
                <h1 class="text-2xl font-bold">{{ auth()->user()->name }}</h1>
                <p class="text-gray-500">{{ auth()->user()->email }}</p>
            </div>
        </div>
        @if($profile->bio)<p class="text-gray-700 mb-4">{{ $profile->bio }}</p>@endif
        <div class="space-y-2 text-gray-600">
            @if($profile->phone)<p>📞 {{ $profile->phone }}</p>@endif
            @if($profile->city)<p>📍 {{ $profile->city }}@if($profile->country), {{ $profile->country }}@endif</p>@endif
            @if($profile->website)<p>🌐 <a href="{{ $profile->website }}" class="text-blue-600 hover:underline">{{ $profile->website }}</a></p>@endif
        </div>
        <div class="mt-6">
            <a href="{{ route('profile.edit') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Edit Profile</a>
        </div>
    </div>
</div>
@endsection
