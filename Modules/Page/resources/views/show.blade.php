@extends('site::layouts.app')

@section('title', $page->metaTitleValue())
@section('description', $page->metaDescriptionValue())

@section('content')
<div class="shell shell--narrow page">
    <article class="stack stack--loose">
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">{{ __('site::messages.home') }}</a>
            <span class="breadcrumb__separator">/</span>
            <span>{{ $page->getAttribute('title') }}</span>
        </nav>

        <header class="stack stack--tight">
            <h1 class="title-page">{{ $page->getAttribute('title') }}</h1>
            @if(filled($page->getAttribute('excerpt')))
                <p class="text-lead">{{ $page->getAttribute('excerpt') }}</p>
            @endif
        </header>

        <div class="card">
            <div class="card__body">
                <div class="prose">
                    @foreach($page->bodyParagraphs() as $paragraph)
                        @php $lines = preg_split('/\R/', $paragraph); @endphp
                        @if(count($lines) > 1)
                            <h2>{{ array_shift($lines) }}</h2>
                            <p>{{ implode(' ', $lines) }}</p>
                        @else
                            <p>{{ $paragraph }}</p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <p class="text-meta">
            {{ __('page::messages.last_updated', ['date' => $page->getAttribute('updated_at')?->isoFormat('LL')]) }}
        </p>
    </article>
</div>
@endsection
