@if ($paginator->hasPages())
    <ul class="pagination m-auto">
{{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            {{-- <li class="prev">
                <a href="#"><i class='fa-solid fa-arrow-left'></i>
                </a>
            </li> --}}

        @else
            <li class="prev">
                <a href="{{ $paginator->previousPageUrl() }}"><i class='fa-solid fa-arrow-left'></i>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            {{-- @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif --}}

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active" >
                            <span class="">{{ $page }}</span>
                        </li>
                    @elseif (count($element)>3 && $page == count($element) - 1)
                        <li class="" >
                            <span class="">.....</span>
                        </li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}  </a></li>

                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="next">
                <a href="{{ $paginator->nextPageUrl() }}"><i class='fa-solid fa-arrow-right'></i>
                </a>
            </li>

        @else
        {{-- <li class="next"><a href="#"><i class='fa-solid fa-arrow-right'></i></a></li> --}}

        @endif
    </ul>
@endif
