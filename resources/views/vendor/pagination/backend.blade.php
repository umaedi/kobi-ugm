@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item">
                    <a href="" class="page-link">
                        Previous
                    </a>
                </li>
            @else
            <li class="page-item">
                <a href="{{ $paginator->previousPageUrl() }}" class="page-link">
                    Previous
                </a>
            </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active page-item">
                                <a href="#" class="page-link">
                                <span>{{ $page }}</span>
                                </a>
                            </li>
                        @else
                            <li class="page-item">
                                <a href="{{ $url }}" class="page-link">
                                <span>{{ $page }}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a href="{{ $paginator->nextPageUrl() }}" class="page-link">
                        Next
                    </a>
                </li>
            @else
            <li class="page-item">
                <a href="" class="page-link">
                    Next
                </a>
            </li>
            @endif
        </ul>
    </nav>
@endif

