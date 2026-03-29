@if ($paginator->hasPages())
    <div class="flex flex-wrap items-center justify-center gap-2 mt-6">
        
        {{-- Tombol Sebelumnya (Previous) --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 text-sm font-medium text-gray-600 bg-white/5 border border-white/5 rounded-xl cursor-not-allowed">
                &laquo; Prev
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 text-sm font-medium text-white bg-white/5 border border-white/10 rounded-xl hover:bg-ukkom-purple/20 hover:border-ukkom-purple/50 transition duration-300">
                &laquo; Prev
            </a>
        @endif

        {{-- Deretan Angka Halaman (Pagination Elements) --}}
        @foreach ($elements as $element)
            
            {{-- Pemisah Tiga Titik (...) --}}
            @if (is_string($element))
                <span class="px-4 py-2 text-sm font-medium text-gray-500 bg-transparent">
                    {{ $element }}
                </span>
            @endif

            {{-- Array dari Link Halaman --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        {{-- Tombol Halaman Aktif (Menyala Tosca) --}}
                        <span class="px-4 py-2 text-sm font-bold text-black bg-ukkom-tosca border border-ukkom-tosca rounded-xl shadow-[0_0_15px_rgba(45,212,191,0.4)]">
                            {{ $page }}
                        </span>
                    @else
                        {{-- Tombol Halaman Tidak Aktif --}}
                        <a href="{{ $url }}" class="px-4 py-2 text-sm font-medium text-gray-300 bg-white/5 border border-white/10 rounded-xl hover:bg-ukkom-tosca/20 hover:text-ukkom-tosca hover:border-ukkom-tosca/50 transition duration-300">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Tombol Selanjutnya (Next) --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 text-sm font-medium text-white bg-white/5 border border-white/10 rounded-xl hover:bg-ukkom-purple/20 hover:border-ukkom-purple/50 transition duration-300">
                Next &raquo;
            </a>
        @else
            <span class="px-4 py-2 text-sm font-medium text-gray-600 bg-white/5 border border-white/5 rounded-xl cursor-not-allowed">
                Next &raquo;
            </span>
        @endif

    </div>
@endif