@if ($paginator->hasPages())
    <ul class="container">
        {{-- Previous Page Link --}}
        @if ($paginator->hasMorePages())
                <a class="btn btn-primary float-right" href="{{ $paginator->nextPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">Older Posts &rarr;</a>
        @endif

        {{-- Pagination Elements --}}


        {{-- Next Page Link --}}
        @if ($paginator->onFirstPage())
        @else
                <a class="btn btn-primary float-left" href="{{ $paginator->previousPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&larr; Newer Posts</a>
        @endif
    </ul>
@endif
