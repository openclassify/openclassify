@extends('app::layouts.app')

@section('content')
    @include('category::partials.index-content', ['categories' => $categories])
@endsection
