@extends('site::layouts.app')

@section('title', $seller->getAttribute('name'))
@section('description', __('site::messages.member_since', ['date' => $seller->getAttribute('created_at')?->isoFormat('LL')]))

@php
    $sellerId = (int) $seller->getKey();
    $maxCount = max(1, max($distribution));
@endphp

@section('content')
<div class="shell shell--wide page">
    <div class="stack stack--section">
        <header class="card">
            <div class="card__body">
                <div class="row row--wrap row--between">
                    <div class="row">
                        <span class="avatar avatar--large">{{ \App\Support\UserDirectory::initials((string) $seller->getAttribute('name')) }}</span>
                        <div class="stack stack--tight" style="gap:2px">
                            <h1 class="title-section">{{ $seller->getAttribute('name') }}</h1>
                            <x-ui.rating :average="$summary['average']" :total="$summary['total']"/>
                            <p class="text-meta">{{ __('site::messages.member_since', ['date' => $seller->getAttribute('created_at')?->isoFormat('LL')]) }}</p>
                        </div>
                    </div>

                    <div class="row row--wrap">
                        @auth
                            @unless($isSelf)
                                <button
                                    type="button"
                                    class="button button--secondary button--small"
                                    data-favorite-toggle="{{ route('favorites.sellers.toggle', $sellerId) }}"
                                >
                                    <x-ui.icon name="heart"/>
                                    <span>{{ __('site::messages.save') }}</span>
                                </button>
                                <button type="button" class="button button--ghost button--small" data-reveal-target="seller-report">
                                    <x-ui.icon name="flag"/>
                                    <span>{{ __('report::messages.report') }}</span>
                                </button>
                            @endunless
                        @endauth
                    </div>
                </div>

                @auth
                    @unless($isSelf)
                        <form method="POST" action="{{ route('reports.store') }}" id="seller-report" class="stack stack--tight" hidden>
                            @csrf
                            <input type="hidden" name="subject_type" value="user">
                            <input type="hidden" name="subject_id" value="{{ $sellerId }}">
                            <div class="field__row field__row--two">
                                <div class="field">
                                    <label class="field__label" for="seller-report-reason">{{ __('report::messages.reason') }}</label>
                                    <select id="seller-report-reason" name="reason" class="select" required>
                                        @foreach(\Modules\Report\Models\Report::reasons() as $reason)
                                            <option value="{{ $reason }}">{{ __('report::messages.reason_'.$reason) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="field">
                                    <label class="field__label" for="seller-report-details">{{ __('report::messages.details') }}</label>
                                    <input id="seller-report-details" type="text" name="details" class="input" maxlength="1000" placeholder="{{ __('report::messages.placeholder') }}">
                                </div>
                            </div>
                            <button type="submit" class="button button--critical button--small">{{ __('report::messages.submit') }}</button>
                        </form>
                    @endunless
                @endauth

                <div class="grid grid--stats">
                    <div class="stat-card">
                        <span class="stat-card__value">{{ number_format($listingCount) }}</span>
                        <span class="stat-card__label">{{ __('site::messages.active_listings') }}</span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-card__value">{{ number_format($summary['total']) }}</span>
                        <span class="stat-card__label">{{ __('review::messages.reviews') }}</span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-card__value">{{ $summary['total'] > 0 ? number_format($summary['average'], 1) : '—' }}</span>
                        <span class="stat-card__label">{{ __('review::messages.rating_summary', ['average' => '']) }}</span>
                    </div>
                </div>
            </div>
        </header>

        <div class="grid grid--split">
            <section class="section">
                <div class="section__head">
                    <h2 class="title-section">{{ __('site::messages.all_listings') }}</h2>
                </div>

                @if($listings->isNotEmpty())
                    <div class="grid grid--listings">
                        @foreach($listings as $listing)
                            <x-ui.listing-card :listing="$listing"/>
                        @endforeach
                    </div>
                    {{ $listings->links('components.pagination') }}
                @else
                    <x-ui.empty-state icon="tag" :title="__('site::messages.no_listings')"/>
                @endif
            </section>

            <aside class="stack stack--loose">
                <section class="card">
                    <div class="card__head">
                        <h2 class="card__title">{{ __('review::messages.reviews') }}</h2>
                    </div>
                    <div class="card__body">
                        <div class="stack stack--tight">
                            @foreach($distribution as $score => $count)
                                <div class="row" style="gap:var(--space-2)">
                                    <span class="text-meta" style="width:1.5rem">{{ $score }}</span>
                                    <span style="flex:1 1 auto;height:6px;border-radius:var(--radius-full);background:var(--ink-100);overflow:hidden">
                                        <span style="display:block;height:100%;width:{{ (int) round(($count / $maxCount) * 100) }}%;background:var(--caution)"></span>
                                    </span>
                                    <span class="text-meta" style="width:2rem;text-align:end">{{ $count }}</span>
                                </div>
                            @endforeach
                        </div>

                        @if($canReview)
                            <div class="divider"></div>
                            <form method="POST" action="{{ route('reviews.store', $sellerId) }}" class="stack stack--tight">
                                @csrf
                                <p class="field__label">{{ __('review::messages.your_rating') }}</p>
                                <div class="rating-input" data-rating-input>
                                    <input type="hidden" name="rating" value="5" data-rating-value>
                                    @for($star = 1; $star <= 5; $star++)
                                        <button type="button" class="rating-input__star is-active" data-rating-star aria-label="{{ $star }}">
                                            <x-ui.icon name="star" stroke="none"/>
                                        </button>
                                    @endfor
                                </div>
                                <div class="field">
                                    <label class="field__label" for="review-title">{{ __('review::messages.review_title') }}</label>
                                    <input id="review-title" type="text" name="title" class="input" maxlength="120">
                                </div>
                                <div class="field">
                                    <label class="field__label" for="review-body">{{ __('review::messages.review_body') }}</label>
                                    <textarea id="review-body" name="body" class="textarea" rows="3" maxlength="2000"></textarea>
                                </div>
                                <button type="submit" class="button button--primary button--block">{{ __('review::messages.submit') }}</button>
                            </form>
                        @elseif(! $isSelf)
                            <a href="{{ route('login') }}" class="button button--secondary button--block">{{ __('review::messages.sign_in_to_review') }}</a>
                        @endif
                    </div>
                </section>

                <section class="card">
                    <div class="card__body">
                        @forelse($reviews as $review)
                            @php $author = $reviewAuthors[$review->authorId()] ?? null; @endphp
                            <article class="review-item">
                                <div class="review-item__head">
                                    <span class="avatar avatar--small">{{ $author['initials'] ?? '?' }}</span>
                                    <div class="stack" style="gap:0">
                                        <span class="review-item__author">{{ $author['name'] ?? '—' }}</span>
                                        <x-ui.rating :average="$review->ratingValue()" :total="1" :show-count="false"/>
                                    </div>
                                    <span class="spacer"></span>
                                    <time class="text-meta" datetime="{{ $review->getAttribute('created_at')?->toIso8601String() }}">
                                        {{ $review->getAttribute('created_at')?->diffForHumans(short: true) }}
                                    </time>
                                </div>
                                @if(filled($review->getAttribute('title')))
                                    <p class="text-body" style="font-weight:var(--weight-medium)">{{ $review->getAttribute('title') }}</p>
                                @endif
                                @if(filled($review->getAttribute('body')))
                                    <p class="review-item__body">{{ $review->getAttribute('body') }}</p>
                                @endif
                            </article>
                        @empty
                            <x-ui.empty-state icon="star" :title="__('review::messages.no_reviews')" :text="__('review::messages.no_reviews_hint')"/>
                        @endforelse

                        {{ $reviews->links('components.pagination') }}
                    </div>
                </section>
            </aside>
        </div>
    </div>
</div>
@endsection
