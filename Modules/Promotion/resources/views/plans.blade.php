@extends('site::layouts.app')

@section('title', __('promotion::messages.plans'))
@section('description', __('promotion::messages.plans_lead'))

@section('content')
<div class="shell page">
    <div class="stack stack--section">
        <header class="stack stack--tight">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">{{ __('site::messages.home') }}</a>
                <span class="breadcrumb__separator">/</span>
                <span>{{ __('promotion::messages.plans') }}</span>
            </nav>
            <h1 class="title-page">{{ __('promotion::messages.plans') }}</h1>
            <p class="text-lead">{{ __('promotion::messages.plans_lead') }}</p>
        </header>

        <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(240px, 1fr))">
            @foreach($plans as $plan)
                <article class="plan-card {{ $plan->getAttribute('grants_featured') ? 'is-featured' : '' }}">
                    <div class="stack stack--tight">
                        <div class="row row--between">
                            <h2 class="title-card">{{ $plan->getAttribute('name') }}</h2>
                            @if($plan->getAttribute('grants_featured'))
                                <span class="badge badge--solid">{{ __('promotion::messages.featured_badge') }}</span>
                            @elseif($plan->getAttribute('grants_urgent'))
                                <span class="badge badge--caution">{{ __('promotion::messages.urgent_badge') }}</span>
                            @endif
                        </div>
                        <p class="plan-card__price">{{ $plan->priceLabel() }}</p>
                        <p class="text-muted">{{ $plan->durationLabel() }}</p>
                    </div>

                    <p class="text-body">{{ $plan->getAttribute('description') }}</p>

                    <ul class="plan-card__features">
                        @foreach($plan->benefitList() as $benefit)
                            <li class="plan-card__feature">
                                <x-ui.icon name="check"/>
                                <span>{{ $benefit }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <a
                        href="{{ auth()->check() ? route('panel.promotions.index') : route('login') }}"
                        class="button {{ $plan->getAttribute('grants_featured') ? 'button--primary' : 'button--secondary' }} button--block"
                    >{{ __('promotion::messages.choose_plan') }}</a>
                </article>
            @endforeach
        </div>
    </div>
</div>
@endsection
