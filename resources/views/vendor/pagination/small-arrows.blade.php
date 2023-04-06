@if ($paginator->hasPages())
    <nav class="mt-2">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled"><span class="page-link"><i class="fas fa-chevron-left fa-xs"></i><i class="fas fa-chevron-left fa-xs"></i></span></li>
            @else
                <li class="page-item"><a href="{{ $paginator->previousPageUrl() }}" class="page-link" rel="prev"><i class="fas fa-chevron-left fa-xs"></i><i class="fas fa-chevron-left fa-xs"></i></a></li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item"><a href="{{ $paginator->nextPageUrl() }}" class="page-link" rel="next"><i class="fas fa-chevron-right fa-xs"></i><i class="fas fa-chevron-right fa-xs"></i></a></li>
            @else
                <li class="page-item disabled"><span class="page-link"><i class="fas fa-chevron-right fa-xs"></i><i class="fas fa-chevron-right fa-xs"></i></span></li>
            @endif
        </ul>
    </nav>
@endif
