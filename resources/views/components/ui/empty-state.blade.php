@props(['icon' => 'grid', 'title', 'text' => null])

<div {{ $attributes->merge(['class' => 'empty-state']) }}>
    <span class="empty-state__icon"><x-ui.icon :name="$icon"/></span>
    <p class="empty-state__title">{{ $title }}</p>
    @if($text)
        <p class="empty-state__text">{{ $text }}</p>
    @endif
    {{ $slot }}
</div>
