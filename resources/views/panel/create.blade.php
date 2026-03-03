@extends('app::layouts.app')

@section('title', 'İlan Ver')

@section('simple_page', '1')

@section('content')
<div class="max-w-[1320px] mx-auto px-4 py-8">
    <section class="bg-white border border-slate-200 rounded-xl p-0 overflow-hidden">
        <livewire:panel-quick-listing-form />
    </section>
</div>
@endsection
