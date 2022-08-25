@if ($paginator->hasPages())
    <nav class="basic-pagination" aria-label="Page navigation">
        <ul>
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item">
                    <a href="">
                        <i class="arrow_left"></i>
                    </a>
                </li>
            @else
            <li class="page-item">
                <a href="{{ $paginator->previousPageUrl() }}">
                    <i class="arrow_left"></i>
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
                            <li class="active">
                                <a href="#">
                                <span>{{ $page }}</span>
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}">
                                <span>{{ $page }}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}">
                        <i class="arrow_right"></i>
                    </a>
                </li>
            @else
            <li>
                <a href="">
                    <i class="arrow_right"></i>
                </a>
            </li>
            @endif
        </ul>
    </nav>
@endif

