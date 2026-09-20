@props(['average' => 0, 'total' => 0, 'showCount' => true])

@php
    $score = (float) $average;
    $rounded = (int) round($score);
@endphp

<span {{ $attributes->merge(['class' => 'rating']) }}>
    <span class="rating__stars" aria-hidden="true">
        @for($star = 1; $star <= 5; $star++)
            <x-ui.icon name="star" class="{{ $star <= $rounded ? '' : 'is-empty' }}" stroke="none"/>
        @endfor
    </span>
    @if($total > 0)
        <span class="rating__value">{{ number_format($score, 1) }}</span>
        @if($showCount)
            <span class="rating__count">({{ $total }})</span>
        @endif
    @else
        <span class="rating__count">{{ __('review::messages.no_reviews') }}</span>
    @endif
</span>
