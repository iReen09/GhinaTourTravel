@extends('components.layout.customer')

@section('title', $paket->nama_paket . ' — Ghina Tour Travel')

@section('extra_styles')
    <style>
        .detail-img {
            background: #ccc;
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        [data-theme="light"] .fas-box {
            background: #fff;
            border: 1px solid var(--border);
        }

        [data-theme="dark"] .fas-box {
            background: #141414;
        }

        .fas-item {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            padding: 6px 0;
            border-bottom: 1px solid var(--border);
        }

        .fas-item:last-child {
            border: none;
        }

        [data-theme="light"] .harga-box {
            background: #fff;
            border: 1px solid var(--border);
        }

        [data-theme="dark"] .harga-box {
            background: #1a1a1a;
        }

        [data-theme="light"] .dest-img-ph {
            opacity: .9;
        }

        .card-ol {
            background: linear-gradient(to bottom, rgba(0, 0, 0, .05) 10%, rgba(5, 2, 17, .94) 88%);
        }

        .paket-card {
            transition: transform .3s, box-shadow .3s;
            cursor: pointer;
            display: block;
        }

        .paket-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(212, 160, 23, .2);
        }
    </style>
@endsection

@section('content')
    <!-- HERO / HEADER PAKET -->
    <div class="relative h-[260px] w-full overflow-hidden mt-[72px]">
        @if ($paket->fotos && $paket->fotos->count() > 0)
            @php $firstFoto = $paket->fotos->first(); @endphp
            <img src="{{ Str::startsWith($firstFoto->path, 'http') ? $firstFoto->path : asset('storage/' . $firstFoto->path) }}"
                alt="{{ $paket->nama_paket }}" class="absolute inset-0 w-full h-full object-cover" />
            <div class="absolute inset-0" style="background:rgba(0,0,0,.45);"></div>
        @else
            <div class="absolute inset-0" style="background:linear-gradient(135deg,#78350f,#d97706);"></div>
            <div class="absolute inset-0" style="background:rgba(0,0,0,.38);"></div>
        @endif
        <div class="absolute inset-0 flex items-center justify-center flex-col gap-2">
            <h1 class="text-[38px] font-bold text-white text-center">{{ $paket->nama_paket }}</h1>
            <p class="text-gray-200 text-base">Paket Wisata</p>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <main class="mx-auto max-w-[1280px] px-14 py-10">

        <!-- Destinasi / Tempat Wisata Images -->
        @if ($paket->tempats && $paket->tempats->count() > 0)
            <div class="mb-10">
                <h2 class="text-[22px] font-bold t mb-4">Destinasi Wisata</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach ($paket->tempats as $tempat)
                        <div class="relative h-[180px] rounded-xl overflow-hidden"
                            style="background:linear-gradient(135deg,#7c3f00,#c97a1a);">
                            @if ($tempat->galleries && $tempat->galleries->count() > 0)
                                @php $firstGal = $tempat->galleries->first(); @endphp
                                <img src="{{ Str::startsWith($firstGal->path, 'http') ? $firstGal->path : asset('storage/' . $firstGal->path) }}"
                                    alt="{{ $tempat->nama_tempat }}" class="absolute inset-0 w-full h-full object-cover" />
                            @endif
                            <div class="absolute inset-0 flex flex-col justify-end p-3"
                                style="background:linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 100%);">
                                <p class="text-white font-semibold text-sm">{{ $tempat->nama_tempat }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Gallery Photos if available -->
        @if ($paket->fotos && $paket->fotos->count() > 1)
            <div class="mb-10">
                <h2 class="text-[22px] font-bold t mb-4">Galeri Foto</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach ($paket->fotos as $foto)
                        <div class="relative h-[180px] rounded-xl overflow-hidden">
                            <img src="{{ Str::startsWith($foto->path, 'http') ? $foto->path : asset('storage/' . $foto->path) }}"
                                alt="{{ $foto->keterangan ?? $paket->nama_paket }}" class="w-full h-full object-cover" />
                            @if ($foto->keterangan)
                                <div class="absolute bottom-0 left-0 right-0 p-2"
                                    style="background:linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 100%);">
                                    <p class="text-white text-xs">{{ $foto->keterangan }}</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Description -->
        <div class="mb-10">
            <h2 class="text-[22px] font-bold t mb-4">Deskripsi Paket</h2>
            <div class="p-6 rounded-2xl" style="background:var(--bg-card);border:1px solid var(--border);">

                @if ($paket->note)
                    <p class="tm leading-7 mt-4">{{ $paket->note }}</p>
                @endif
            </div>
        </div>

        <!-- Fasilitas + Harga -->
        <div class="flex gap-8 flex-col lg:flex-row">

            <!-- Fasilitas -->
            <div class="fas-box flex-1 rounded-2xl p-7">
                <h2 class="text-[22px] font-bold t mb-5">Fasilitas</h2>

                @if ($paket->transportasis && $paket->transportasis->count() > 0)
                    <div class="mb-4">
                        <p class="font-semibold t mb-2 text-[15px]">a. Transportasi</p>
                        <div class="space-y-1 ml-1">
                            @foreach ($paket->transportasis as $transportasi)
                                <div class="fas-item"><span class="tm text-sm">–</span><span
                                        class="tm text-sm">{{ $transportasi->fasilitas_transportasi }}</span></div>
                            @endforeach
                            <div class="fas-item"><span class="tm text-sm">–</span><span class="tm text-sm">AC (Air
                                    Conditioner)</span></div>
                            <div class="fas-item"><span class="tm text-sm">–</span><span class="tm text-sm">Audio
                                    System</span></div>
                            <div class="fas-item"><span class="tm text-sm">–</span><span class="tm text-sm">Reclining
                                    Seat</span></div>
                        </div>
                    </div>
                @else
                    <div class="mb-4">
                        <p class="font-semibold t mb-2 text-[15px]">a. Transportasi</p>
                        <div class="space-y-1 ml-1">
                            <div class="fas-item"><span class="tm text-sm">–</span><span class="tm text-sm">Bus
                                    Pariwisata</span></div>
                            <div class="fas-item"><span class="tm text-sm">–</span><span class="tm text-sm">AC (Air
                                    Conditioner)</span></div>
                            <div class="fas-item"><span class="tm text-sm">–</span><span class="tm text-sm">Audio
                                    System</span></div>
                            <div class="fas-item"><span class="tm text-sm">–</span><span class="tm text-sm">Reclining
                                    Seat</span></div>
                        </div>
                    </div>
                @endif

                @if ($paket->akomodasis && $paket->akomodasis->count() > 0)
                    <div class="mb-4">
                        <p class="font-semibold t mb-2 text-[15px]">b. Akomodasi</p>
                        <div class="space-y-1 ml-1">
                            <div class="fas-item"><span class="tm text-sm">–</span><span class="tm text-sm">Tour
                                    Leader</span></div>
                            <div class="fas-item"><span class="tm text-sm">–</span><span class="tm text-sm">Tiket Masuk
                                    Objek Wisata</span></div>
                            <div class="fas-item"><span class="tm text-sm">–</span><span class="tm text-sm">P3K + Asuransi
                                    Wisata</span></div>
                            @foreach ($paket->akomodasis as $akomodasi)
                                <div class="fas-item"><span class="tm text-sm">–</span><span
                                        class="tm text-sm">{{ $akomodasi->fasilitas_akomodasi }}</span></div>
                            @endforeach
                            <div class="fas-item"><span class="tm text-sm">–</span><span class="tm text-sm">Retribusi
                                    Perjalanan (Tol, Parkir, dll)</span></div>
                        </div>
                    </div>
                @else
                    <div class="mb-4">
                        <p class="font-semibold t mb-2 text-[15px]">b. Akomodasi</p>
                        <div class="space-y-1 ml-1">
                            <div class="fas-item"><span class="tm text-sm">–</span><span class="tm text-sm">Tour
                                    Leader</span></div>
                            <div class="fas-item"><span class="tm text-sm">–</span><span class="tm text-sm">Tiket Masuk
                                    Objek Wisata</span></div>
                            <div class="fas-item"><span class="tm text-sm">–</span><span class="tm text-sm">P3K +
                                    Asuransi Wisata</span></div>
                            <div class="fas-item"><span class="tm text-sm">–</span><span class="tm text-sm">Retribusi
                                    Perjalanan (Tol, Parkir, dll)</span></div>
                        </div>
                    </div>
                @endif

                @if ($paket->konsumsis && $paket->konsumsis->count() > 0)
                    <div>
                        <p class="font-semibold t mb-2 text-[15px]">c. Konsumsi</p>
                        <div class="space-y-1 ml-1">
                            @foreach ($paket->konsumsis as $konsumsi)
                                <div class="fas-item"><span class="tm text-sm">–</span><span
                                        class="tm text-sm">{{ $konsumsi->fasilitas_konsumsi }}</span></div>
                            @endforeach
                            <div class="fas-item"><span class="tm text-sm">–</span><span class="tm text-sm">Snack</span>
                            </div>
                            <div class="fas-item"><span class="tm text-sm">–</span><span class="tm text-sm">Air
                                    Mineral</span></div>
                        </div>
                    </div>
                @else
                    <div>
                        <p class="font-semibold t mb-2 text-[15px]">c. Konsumsi</p>
                        <div class="space-y-1 ml-1">
                            <div class="fas-item"><span class="tm text-sm">–</span><span class="tm text-sm">Makan
                                    2x</span></div>
                            <div class="fas-item"><span class="tm text-sm">–</span><span class="tm text-sm">Snack</span>
                            </div>
                            <div class="fas-item"><span class="tm text-sm">–</span><span class="tm text-sm">Air
                                    Mineral</span></div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Harga & CTA -->
            <div class="w-full lg:w-[300px] flex-shrink-0 space-y-4">
                <div class="harga-box rounded-2xl p-6 space-y-3">
                    <p class="tm text-sm">Harga Paket Tour</p>
                    <p class="text-[26px] font-bold t">Rp {{ number_format($paket->harga_paket, 0, ',', '.') }}<span
                            class="text-base font-normal tm">/pax</span></p>
                    <p class="text-xs font-bold" style="color:#dc2626;">NB : HARGA SEWAKTU WAKTU BISA BERUBAH</p>

                    <hr style="border-color:var(--border);" />

                    <div class="space-y-2 text-sm tm">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 flex-shrink-0" style="color:var(--gold);" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" />
                            </svg>
                            <span>{{ $paket->durasi ?? '1 Hari' }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 flex-shrink-0" style="color:var(--gold);" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5z" />
                            </svg>
                            <span>Min. {{ $paket->minimal_peserta ?? 50 }} Pax</span>
                        </div>

                    </div>
                </div>

                <a href="https://wa.me/6281390162558?text=Halo%20Ghina%20Tour%20Travel,%20saya%20tertarik%20dengan%20paket%20{{ urlencode($paket->nama_paket) }}."
                    target="_blank" class="btn btn-gold w-full justify-center text-[15px] py-4">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                    </svg>
                    Pesan via WhatsApp
                </a>
                <a href="{{ route('packages') }}" class="btn w-full justify-center text-[14px] py-3"
                    style="border:1px solid var(--border);background:transparent;color:var(--text);">
                    ← Kembali ke Semua Paket
                </a>
            </div>
        </div>
    </main>
@endsection
