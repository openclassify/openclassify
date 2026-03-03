@extends('app::layouts.app')
@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">{{ __('messages.categories') }}</h1>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach($categories as $category)
        <a href="{{ route('categories.show', $category) }}" class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition hover:bg-blue-50">
            <div class="text-4xl mb-3">{{ $category->icon ?? '📦' }}</div>
            <h3 class="font-semibold text-gray-900">{{ $category->name }}</h3>
            <p class="text-gray-500 text-sm mt-1">{{ $category->children->count() }} subcategories</p>
        </a>
        @endforeach
    </div>
</div>
@endsection
