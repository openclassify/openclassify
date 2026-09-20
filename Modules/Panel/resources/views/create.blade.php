@extends('site::layouts.app')

@section('title', __('panel::messages.new_listing'))
@section('chromeless', '0')

@section('content')
<livewire:panel-quick-listing-form />
@endsection
