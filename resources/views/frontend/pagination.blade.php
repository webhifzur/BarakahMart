<ul class="pagination justify-content-center">
    @if ($paginator->onFirstPage())
        <li class="page-item">
            <a class="page-link" tabindex="-1" aria-disabled="true"><i class="fas fa-caret-left"></i></a>
        </li>
    @else 
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1" aria-disabled="true"><i class="fas fa-caret-left"></i></a>
        </li>
    @endif

    @if (is_array($elements[0]))
        @foreach ($elements[0] as $page => $url)
            @if ($page == $paginator->currentPage())
                <li class="page-item active"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endif
        @endforeach
    @endif

    @if ($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" tabindex="-1" aria-disabled="true"><i class="fas fa-caret-right"></i></a>
        </li>
    @else 
        <li class="page-item">
            <a class="page-link" tabindex="-1" aria-disabled="true"><i class="fas fa-caret-right"></i></a>
        </li>
    @endif
    
</ul>