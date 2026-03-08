@php
    $image = is_array($image ?? null) ? $image : null;
    $fallback = is_string($image['fallback'] ?? null) ? trim((string) $image['fallback']) : '';
    $mobile = is_string($image['mobile'] ?? null) ? trim((string) $image['mobile']) : '';
    $desktop = is_string($image['desktop'] ?? null) ? trim((string) $image['desktop']) : '';
    $altText = trim((string) ($alt ?? ($image['alt'] ?? '')));
    $imageClass = trim((string) ($class ?? ''));
    $loadingMode = trim((string) ($loading ?? 'lazy'));
    $fetchPriority = trim((string) ($fetchpriority ?? ''));
    $sizesValue = trim((string) ($sizes ?? ''));
@endphp

@if($fallback !== '' || $mobile !== '' || $desktop !== '')
<picture>
    @if($mobile !== '')
    <source media="(max-width: 767px)" srcset="{{ $mobile }}">
    @endif
    @if($desktop !== '')
    <source media="(min-width: 768px)" srcset="{{ $desktop }}">
    @endif
    <img
        src="{{ $fallback !== '' ? $fallback : ($desktop !== '' ? $desktop : $mobile) }}"
        alt="{{ $altText }}"
        class="{{ $imageClass }}"
        loading="{{ $loadingMode }}"
        decoding="async"
        @if($fetchPriority !== '') fetchpriority="{{ $fetchPriority }}" @endif
        @if($sizesValue !== '') sizes="{{ $sizesValue }}" @endif
    >
</picture>
@endif
