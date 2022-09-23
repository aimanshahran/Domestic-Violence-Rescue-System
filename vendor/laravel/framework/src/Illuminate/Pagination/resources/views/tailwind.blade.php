@if ($paginator->hasPages())
    <div class="pagination-wrapper" aria-label="{{ __('Pagination Navigation') }}">
        <div class="pagination">
            @if ($paginator->onFirstPage())
                <span class="prev page-numbers">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a class="prev page-numbers current" href="{{ $paginator->previousPageUrl() }}">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

                <span class="page-numbers current">{{ $paginator->currentPage() }}</span>
                <span class="page-numbers">{!! __('of') !!}</span>
                <span class="page-numbers">{{ $paginator->lastPage() }}</span>

            @if ($paginator->hasMorePages())
                <a class="prev page-numbers current" href="{{ $paginator->nextPageUrl() }}">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="prev page-numbers">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        <div>
    </div>
@endif
