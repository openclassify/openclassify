@extends('app::layouts.app')

@section('title', trim((string) ($selectedCategory?->name ?? '')) !== '' ? trim((string) $selectedCategory->name).' Listings and Prices' : 'All Listings and Prices')

@section('content')
    @include('listing::partials.index-content')
@endsection
