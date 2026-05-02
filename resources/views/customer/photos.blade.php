@extends('components.layout.customer')

@section('title', 'Galeri Foto — Ghina Tour Travel')

@section('extra_styles')
    <style>
        .foto-item {
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
            transition: transform .25s, opacity .25s;
            aspect-ratio: 1/1;
        }

        .foto-item:hover {
            transform: scale(1.04);
            opacity: .9;
        }

        /* Lightbox */
        #lightbox {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .88);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        #lightbox.open {
            display: flex;
        }

        #lightbox-img {
            max-width: 80vw;
            max-height: 80vh;
            border-radius: 12px;
            object-fit: contain;
        }

        #lightbox-video {
            max-width: 80vw;
            max-height: 80vh;
            border-radius: 12px;
        }

        #lightbox-close {
            position: absolute;
            top: 24px;
            right: 32px;
            font-size: 32px;
            color: #fff;
            cursor: pointer;
            font-weight: 300;
            line-height: 1;
            z-index: 10;
        }

        #lightbox-label {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            color: #ddd;
            font-size: 14px;
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

        .video-play-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0,0,0,.25);
            z-index: 2;
        }
    </style>
@endsection

@section('content')
    <!-- MAIN -->
    <main class="mx-auto max-w-[1280px] px-14 py-10 mt-[72px]">
        <div class="mb-8 text-center">
            <h1 class="text-[30px] font-bold t">Semua Galeri</h1>
            <p class="tm mt-1">Dokumentasi perjalanan wisata bersama Ghina Tour Travel</p>
        </div>

        @if ($fotos->count() > 0)
            <!-- Grid 6 kolom -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-3">
                @foreach ($fotos as $index => $foto)
                    @php
                        $colors = ['#7c3f00', '#c97a1a', '#1e3a5f', '#2d6a9f', '#1a5c2e', '#2e9952', '#3b0764', '#6d28d9', '#7f1d1d', '#dc2626', '#134e4a', '#0d9488'];
                        $color = $colors[$index % count($colors)];
                        $mediaSrc = $foto->path ? (Str::startsWith($foto->path, 'http') ? $foto->path : asset('storage/' . $foto->path)) : '';
                        $isVideo = $foto->type === 'video';
                    @endphp
                    <div class="foto-item relative group"
                        onclick="openLightbox('{{ $mediaSrc }}', '{{ $foto->paket->nama_paket ?? 'Galeri' }}', '{{ $color }}', {{ $isVideo ? 'true' : 'false' }})">
                        @if ($isVideo && $foto->path)
                            <video class="w-full h-full object-cover" muted preload="metadata">
                                <source src="{{ $mediaSrc }}" type="video/mp4">
                            </video>
                            <div class="video-play-overlay">
                                <svg class="w-12 h-12 text-white/80" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        @elseif ($foto->path)
                            <img src="{{ $mediaSrc }}" alt="{{ $foto->paket->nama_paket ?? 'Galeri' }}"
                                class="w-full h-full object-cover" />
                        @else
                            <div class="w-full h-full flex items-center justify-center"
                                style="background:{{ $color }};">
                                <svg class="w-12 h-12 text-white/30" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z" />
                                </svg>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-all flex items-end p-2" style="z-index:3;">
                            @if ($foto->paket)
                                <p
                                    class="text-white text-xs font-medium opacity-0 group-hover:opacity-100 transition-opacity">
                                    {{ $foto->paket->nama_paket }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if ($fotos->hasPages())
                <div class="mt-10 flex items-center justify-center gap-2">
                    @if ($fotos->onFirstPage())
                        <button class="pg-btn" disabled>‹ Prev</button>
                    @else
                        <a href="{{ $fotos->previousPageUrl() }}" class="pg-btn">‹ Prev</a>
                    @endif

                    @foreach ($fotos->getUrlRange(1, $fotos->lastPage()) as $page => $url)
                        <a href="{{ $url }}"
                            class="pg-btn {{ $page == $fotos->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                    @endforeach

                    @if ($fotos->hasMorePages())
                        <a href="{{ $fotos->nextPageUrl() }}" class="pg-btn">Next ›</a>
                    @else
                        <button class="pg-btn" disabled>Next ›</button>
                    @endif
                </div>
            @endif
        @else
            <div class="text-center py-16">
                <div class="mb-4">
                    <svg class="w-20 h-20 mx-auto tm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold t mb-2">Tidak Ada Foto</h3>
                <p class="tm mb-6">Galeri foto akan segera ditambahkan.</p>
                <a href="{{ route('home') }}" class="btn btn-gold">Kembali ke Beranda</a>
            </div>
        @endif
    </main>

    <!-- LIGHTBOX -->
    <div id="lightbox" onclick="closeLightbox()">
        <span id="lightbox-close" onclick="closeLightbox()">×</span>
        <div id="lightbox-inner" style="display:flex;align-items:center;justify-content:center;width:100%;height:100%;" onclick="event.stopPropagation()">
            <img id="lightbox-img" src="" alt="" style="display:none;" />
            <video id="lightbox-video" controls style="display:none;">
                <source id="lightbox-video-src" src="" type="video/mp4">
            </video>
            <div id="lightbox-ph"
                style="width:500px;height:350px;border-radius:16px;display:flex;align-items:center;justify-content:center;flex-direction:column;gap:10px;">
                <svg id="lightbox-icon" style="width:48px;height:48px;color:rgba(255,255,255,0.5);" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z" />
                </svg>
                <p id="lightbox-label2" style="color:rgba(255,255,255,0.8);font-size:15px;font-weight:600;"></p>
                <p style="color:rgba(255,255,255,0.5);font-size:12px;">Dokumentasi tour</p>
            </div>
        </div>
    </div>
@endsection

@section('extra_scripts')
    <script>
        function openLightbox(src, label, color, isVideo = false) {
            const lightbox = document.getElementById('lightbox');
            const img = document.getElementById('lightbox-img');
            const video = document.getElementById('lightbox-video');
            const videoSrc = document.getElementById('lightbox-video-src');
            const ph = document.getElementById('lightbox-ph');
            const label2 = document.getElementById('lightbox-label2');

            // Reset
            img.style.display = 'none';
            video.style.display = 'none';
            ph.style.display = 'none';

            if (src && isVideo) {
                videoSrc.src = src;
                video.load();
                video.style.display = 'block';
            } else if (src) {
                img.src = src;
                img.style.display = 'block';
            } else {
                ph.style.display = 'flex';
                ph.style.background = color;
            }

            label2.textContent = label || 'Galeri';
            lightbox.classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            const video = document.getElementById('lightbox-video');
            video.pause();
            lightbox.classList.remove('open');
            document.body.style.overflow = '';
        }

        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLightbox();
            }
        });
    </script>
@endsection
