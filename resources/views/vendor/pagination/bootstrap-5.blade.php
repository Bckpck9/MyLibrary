@if ($paginator->hasPages())
    <nav style="margin-top: 24px;">
        <div style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
            @if ($paginator->onFirstPage())
                <span style="padding:8px 12px; background:#ccc; color:#666; border-radius:8px;">Previous</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   style="padding:8px 12px; background:#222; color:white; text-decoration:none; border-radius:8px;">
                    Previous
                </a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span style="padding:8px 12px; color:#666;">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span style="padding:8px 12px; background:#0d6efd; color:white; border-radius:8px;">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                               style="padding:8px 12px; background:#f1f1f1; color:#222; text-decoration:none; border-radius:8px;">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   style="padding:8px 12px; background:#222; color:white; text-decoration:none; border-radius:8px;">
                    Next
                </a>
            @else
                <span style="padding:8px 12px; background:#ccc; color:#666; border-radius:8px;">Next</span>
            @endif
        </div>
    </nav>
@endif