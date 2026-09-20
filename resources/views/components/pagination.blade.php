@if ($paginator->hasPages())
    <nav class="pagination" role="navigation" aria-label="{{ __('Pagination Navigation') }}">
        @if ($paginator->onFirstPage())
            <span class="pagination__item" aria-disabled="true"><x-ui.icon name="chevron-left"/></span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination__item" rel="prev" aria-label="{{ __('pagination.previous') }}">
                <x-ui.icon name="chevron-left"/>
            </a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="pagination__item" aria-disabled="true">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="pagination__item" aria-current="page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="pagination__item">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination__item" rel="next" aria-label="{{ __('pagination.next') }}">
                <x-ui.icon name="chevron-right"/>
            </a>
        @else
            <span class="pagination__item" aria-disabled="true"><x-ui.icon name="chevron-right"/></span>
        @endif
    </nav>
@endif
