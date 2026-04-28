@extends('components.layout.customer')

@section('title', 'Semua Paket — Ghina Tour Travel')

@section('extra_styles')
    <style>
        .search-bar {
            background: var(--bg-card);
            border: 1px solid var(--border);
        }

        [data-theme="light"] .search-input {
            background: #f5f0e8;
            border: 1px solid var(--border);
            color: var(--text);
        }

        [data-theme="dark"] .search-input {
            background: #1e1e1e;
            border: 1px solid var(--border);
            color: var(--text);
        }

        .search-input::placeholder {
            color: var(--text-muted);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--gold);
        }

        .pg-btn {
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            border: 1px solid var(--border);
            background: var(--bg-card);
            color: var(--text);
            transition: all .2s;
        }

        .pg-btn:hover,
        .pg-btn.active {
            background: var(--gold);
            color: #000;
            border-color: var(--gold);
        }

        .pg-btn:disabled {
            opacity: 0.4;
            cursor: default;
        }

        [data-theme="light"] .sec-top {
            background: #F0EBE0;
        }

        [data-theme="dark"] .sec-top {
            background: #0d0d0d;
        }
    </style>
@endsection

@section('content')
    <!-- SEARCH BAR -->
    <div class="sec-top py-8 mt-[78px]">
        <div class="mx-auto max-w-[1280px] px-14">
            <form action="{{ route('packages.search') }}" method="GET" class="flex items-center gap-3">
                <div class="relative flex-1 max-w-[420px]">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 tm" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" name="q" placeholder="Cari paket wisata..." value="{{ $query ?? '' }}"
                        class="search-input w-full rounded-full pl-12 pr-5 py-3 text-[15px]" />
                </div>
                <button type="submit" class="btn btn-gold px-6 py-3">Cari</button>
                @if (isset($query) && $query)
                    <a href="{{ route('packages') }}" class="btn btn-out px-6 py-3">Reset</a>
                @endif
            </form>
        </div>
    </div>

    <!-- PAKET LIST -->
    <main class="mx-auto max-w-[1280px] px-14 py-10">
        <h1 class="text-[26px] font-bold t mb-8">
            @if (isset($query) && $query)
                Hasil Pencarian: "{{ $query }}"
            @else
                Semua Paket
            @endif
        </h1>

        @if ($pakets->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach ($pakets as $paket)
                    <?php
                    $isOvernight = str_contains(strtolower($paket->durasi ?? ''), 'inap') || (str_contains(strtolower($paket->durasi ?? ''), 'hari') && (int) filter_var($paket->durasi ?? '', FILTER_SANITIZE_NUMBER_INT) > 1);
                    $durasiColor = $isOvernight ? '#2563eb' : '#D4A017';
                    $durasiTextColor = $isOvernight ? '#fff' : '#000';
                    ?>
                    <a href="{{ route('package.detail', $paket->id) }}" class="paket-card">
                        <div class="relative h-[300px] overflow-hidden rounded-3xl">
                            <div class="absolute inset-0 z-10 flex flex-col justify-end gap-2 card-ol p-4">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <span class="text-[10px] font-bold rounded-full px-2 py-0.5"
                                            style="background:{{ $durasiColor }};color:{{ $durasiTextColor }};">{{ $paket->durasi ?? '1 Hari' }}</span>
                                        <h3 class="text-[15px] font-bold text-white mt-1">{{ $paket->nama_paket }}</h3>
                                        <p class="text-sm font-semibold" style="color:#f0c94d;">Rp
                                            {{ number_format($paket->harga_per_pax, 0, ',', '.') }}<span
                                                class="text-white font-normal text-xs">/pax</span></p>
                                    </div>
                                </div>
                            </div>
                            @if ($paket->fotos && $paket->fotos->count() > 0)
                                @php $firstFoto = $paket->fotos->first(); @endphp
                                <img src="{{ Str::startsWith($firstFoto->path, 'http') ? $firstFoto->path : asset('storage/' . $firstFoto->path) }}"
                                    alt="{{ $paket->nama_paket }}" class="absolute inset-0 w-full h-full object-cover" />
                            @else
                                <div class="h-full w-full" style="background:linear-gradient(135deg,#7c3f00,#c97a1a);">
                                </div>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-10 flex items-center justify-center gap-2">
                @if ($pakets->hasPages())
                    @if ($pakets->onFirstPage())
                        <button class="pg-btn" disabled>‹ Prev</button>
                    @else
                        <a href="{{ $pakets->previousPageUrl() }}" class="pg-btn">‹ Prev</a>
                    @endif

                    @foreach ($pakets->getUrlRange(1, $pakets->lastPage()) as $page => $url)
                        <a href="{{ $url }}"
                            class="pg-btn {{ $page == $pakets->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                    @endforeach

                    @if ($pakets->hasMorePages())
                        <a href="{{ $pakets->nextPageUrl() }}" class="pg-btn">Next ›</a>
                    @else
                        <button class="pg-btn" disabled>Next ›</button>
                    @endif
                @endif
            </div>
        @else
            <div class="text-center py-16">
                <div class="mb-4">
                    <svg class="w-20 h-20 mx-auto tm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold t mb-2">Tidak Ada Paket Ditemukan</h3>
                <p class="tm mb-6">Maaf, tidak ada paket wisata yang sesuai dengan pencarian Anda.</p>
                <a href="{{ route('packages') }}" class="btn btn-gold">Lihat Semua Paket</a>
            </div>
        @endif
    </main>
@endsection
