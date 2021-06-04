@if ($paginator->hasPages())
    <ul class="pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @php
            /** @HACK reduce paginator block width */
            $countDots = array_reduce($elements, function ($carry, $element) { return $carry + is_string($element); }, 0);
            $keys      = array_keys($elements);
            $firstKey  = reset($keys);
            $lastKey   = last($keys);

            switch ($countDots) {
                case 1:
                    if (count($elements[$firstKey]) >= $paginator->onEachSide * 2 + 2) {
                        $keys = array_keys($elements[$lastKey]);
                        $firstElementKey = reset($keys);
                        unset($elements[$lastKey][$firstElementKey]);
                    } elseif (count($elements[$lastKey]) >= $paginator->onEachSide * 2 + 2) {
                        $keys = array_keys($elements[$firstKey]);
                        $lastElementKey = end($keys);
                        unset($elements[$firstKey][$lastElementKey]);
                    }
                    break;

                case 2:
                    // delete first before first dots
                    $keys = array_keys($elements[$firstKey]);
                    $lastElementKey = end($keys);
                    unset($elements[$firstKey][$lastElementKey]);
                    // delete first after first dots
                    $keys = array_keys($elements[$lastKey]);
                    $firstElementKey = reset($keys);
                    unset($elements[$lastKey][$firstElementKey]);
                    break;
            }

            // remove ... if sequential page numbers
            if (1 <= $countDots) {
                $elements  = array_values($elements);
                $keys      = array_keys($elements);
                $firstKey  = reset($keys);
                $lastKey   = last($keys);

                $keys            = array_keys($elements[$firstKey]);
                $lastElementKey  = last($keys);
                $keys            = array_keys($elements[$firstKey + 2]);
                $firstElementKey = reset($keys);
                if ($lastElementKey + 1 === $firstElementKey) {
                    unset($elements[$firstKey + 1]);
                }
                if (2 <= $countDots) {
                    $keys            = array_keys($elements[$lastKey - 2]);
                    $lastElementKey  = last($keys);
                    $keys            = array_keys($elements[$lastKey]);
                    $firstElementKey = reset($keys);
                    if ($lastElementKey + 1 === $firstElementKey) {
                        unset($elements[$lastKey - 1]);
                    }
                }
            }
        @endphp
        @foreach ($elements as $key => $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled page-link-separator" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">&rsaquo;</span>
            </li>
        @endif
    </ul>
@endif
