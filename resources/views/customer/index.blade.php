@extends('components.layout.customer')

@section('title', 'Ghina Tour Travel — Serving With Love')

@section('content')
    <!-- ===== HERO ===== -->
    <section id="beranda" class="relative h-[750px] w-full">
        <div class="absolute inset-0 z-10" style="background:var(--hero-overlay);"></div>
        <div class="absolute inset-0 z-0"
            style="background-image:url('https://images.unsplash.com/photo-1537953773345-d172ccf13cf1?w=1600&q=80');background-size:cover;background-position:center;">
        </div>

        <div class="relative z-20 mx-auto grid h-full w-full max-w-[1280px] items-center px-14">
            <div class="fade-in">
                <span class="inline-block rounded-full border px-4 py-1 text-sm font-medium mb-4"
                    style="background:rgba(212,160,23,.15);border-color:rgba(212,160,23,.4);color:#f0c94d;">
                    ✈ Biro Perjalanan Wisata Terpercaya Sejak 2010
                </span>
                <h1 class="w-[56%] text-[48px] font-bold leading-tight text-white">
                    Dapatkan Momen Tak Terlupakan Bersama Kami
                </h1>
                <p class="w-[38%] text-[15px] leading-8 text-gray-200 mt-4">
                    PT Ghina Tour Travel — solusi perjalanan wisata rombongan dengan harga sesuai anggaran Anda. Terpercaya,
                    Fleksibel & Fun.
                </p>
                <div class="mt-9 flex items-center gap-4">
                    <a href="{{ route('packages') }}" class="btn btn-gold text-[15px] px-8 py-4">Lihat Paket Wisata</a>
                    <a href="#tentang" class="btn text-[15px] px-8 py-4 text-white"
                        style="background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.3);backdrop-filter:blur(4px);">
                        Tentang Kami
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats bar -->
        <div class="absolute inset-x-0 -bottom-16 z-20 mx-auto max-w-[1280px] px-14">
            <div class="stats-bar flex justify-between rounded-2xl px-11 py-5">
                <div class="flex items-center gap-4">
                    <div class="flex h-[60px] w-[60px] items-center justify-center rounded-full"
                        style="background:var(--gold);">
                        <svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-[24px] font-bold t">48+</h2>
                        <p class="text-sm tm">Klien Setia</p>
                    </div>
                </div>
                <div class="w-px" style="background:var(--border);"></div>
                <div class="flex items-center gap-4">
                    <div class="flex h-[60px] w-[60px] items-center justify-center rounded-full"
                        style="background:var(--gold);">
                        <svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-[24px] font-bold t">{{ $pakets->count() }}+</h2>
                        <p class="text-sm tm">Paket Wisata</p>
                    </div>
                </div>
                <div class="w-px" style="background:var(--border);"></div>
                <div class="flex items-center gap-4">
                    <div class="flex h-[60px] w-[60px] items-center justify-center rounded-full"
                        style="background:var(--gold);">
                        <svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 4l5 2.18V11c0 3.5-2.33 6.79-5 7.93C9.33 17.79 7 14.5 7 11V7.18L12 5z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-[24px] font-bold t">100%</h2>
                        <p class="text-sm tm">Terpercaya</p>
                    </div>
                </div>
                <div class="w-px" style="background:var(--border);"></div>
                <div class="flex items-center gap-4">
                    <div class="flex h-[60px] w-[60px] items-center justify-center rounded-full"
                        style="background:var(--gold);">
                        <svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zm.01 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67V7z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-[24px] font-bold t">14+</h2>
                        <p class="text-sm tm">Tahun Pengalaman</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ===== TENTANG ===== -->
    <section id="tentang" class="mx-auto mt-[100px] flex max-w-[1280px] gap-16 px-14 pt-20 fade-in">
        <!-- Kiri -->
        <div class="flex-shrink-0 w-[430px] space-y-5">
            <span class="font-semibold text-sm uppercase tracking-widest" style="color:var(--gold);">Tentang Kami</span>
            <h2 class="text-[28px] font-bold t leading-tight">Biro Perjalanan Wisata Terpercaya dari Purwokerto</h2>
            <p class="tm leading-8 text-[15px]">PT Ghina Tour Travel adalah biro perjalanan wisata yang selalu mengerti dan
                mengutamakan kebutuhan konsumen. Hadir sejak <strong class="t">20 April 2010</strong>, kami melayani
                perjalanan rombongan dengan harga fleksibel sesuai anggaran Anda.</p>
            <p class="tm leading-8 text-[15px]">Tahun 2024 kami rebranding dari <em>Dira Wisata</em> menjadi <strong
                    class="t">PT Ghina Tour Travel</strong>: <span class="font-semibold"
                    style="color:var(--gold);">Terpercaya, Fleksibel & Fun</span>.</p>

            <div class="visi-card rounded-2xl p-5 space-y-4">
                <div class="flex items-start gap-3">
                    <div class="mt-0.5 h-7 w-7 flex-shrink-0 flex items-center justify-center rounded-full text-black text-xs font-bold"
                        style="background:var(--gold);">V</div>
                    <div>
                        <p class="t font-semibold text-sm">Visi</p>
                        <p class="tm text-sm leading-6">Menjadi perusahaan tour travel pilihan konsumen dengan layanan yang
                            unik dan berkesan di Indonesia.</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="mt-0.5 h-7 w-7 flex-shrink-0 flex items-center justify-center rounded-full text-black text-xs font-bold"
                        style="background:var(--gold);">M</div>
                    <div>
                        <p class="t font-semibold text-sm">Misi</p>
                        <p class="tm text-sm leading-6">Menjaga hubungan jangka panjang dengan pelanggan serta menyediakan
                            pelayanan terbaik di bidang pariwisata dan perhotelan.</p>
                    </div>
                </div>
            </div>

            <div class="flex gap-3">
                <a href="https://wa.me/6281390162558" target="_blank" class="btn btn-gold">Hubungi Sekarang</a>
                <a href="{{ route('packages') }}" class="btn btn-out">Lihat Paket</a>
            </div>
        </div>

        <!-- Kanan: hanya 2 layanan -->
        <div class="flex flex-col gap-4 w-[320px]">
            <div class="svc-card flex items-center gap-4 rounded-[18px] px-5 py-5">
                <div class="h-14 w-14 flex-shrink-0 flex items-center justify-center rounded-full"
                    style="background:var(--gold);">
                    <svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-[15px] font-bold t">Tour Inbound & Outbound</h3>
                    <p class="text-xs tm mt-0.5">Wisata domestik & mancanegara untuk rombongan</p>
                </div>
            </div>

            <div class="svc-card flex items-center gap-4 rounded-[18px] px-5 py-5">
                <div class="h-14 w-14 flex-shrink-0 flex items-center justify-center rounded-full"
                    style="background:var(--gold);">
                    <svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M17 5H3c-1.1 0-2 .89-2 2v9h2c0 1.65 1.34 3 3 3s3-1.35 3-3h5.5c0 1.65 1.34 3 3 3s3-1.35 3-3H23v-5l-6-6zM6 15.5c-.83 0-1.5-.67-1.5-1.5S5.17 12.5 6 12.5s1.5.67 1.5 1.5S6.83 15.5 6 15.5zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5S17.83 15.5 17 15.5zM17 9l1.5 2H3V7h14v2z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-[15px] font-bold t">Sewa Bus Pariwisata</h3>
                    <p class="text-xs tm mt-0.5">Bus AC, audio, reclining seat & nyaman</p>
                </div>
            </div>

            <div class="rounded-[18px] px-5 py-5 text-black"
                style="background:linear-gradient(135deg,var(--gold),var(--gold-dark));">
                <p class="font-bold text-[14px]">🏆 Sudah melayani 48+ institusi</p>
                <p class="text-[12px] mt-1 opacity-75">Sekolah, BUMDES, instansi pemerintah & swasta se-Banyumas</p>
            </div>
        </div>
    </section>


    <!-- ===== PAKET ===== -->
    <section id="paket" class="mt-[100px] py-14 sec-bg">
        <div class="mx-auto max-w-[1280px] space-y-8 px-14">
            <div class="flex items-end justify-between fade-in">
                <div>
                    <span class="font-semibold text-sm uppercase tracking-widest" style="color:var(--gold);">Destinasi
                        Pilihan</span>
                    <h2 class="text-[28px] font-bold t mt-1">Paket Wisata Kami</h2>
                    <p class="tm">Tersedia berbagai pilihan destinasi dengan harga terjangkau</p>
                </div>
                <a href="{{ route('packages') }}" class="btn btn-gold">Semua Paket</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 fade-in">
                @forelse($pakets as $paket)
                    <a href="{{ route('package.detail', $paket->id) }}" class="paket-card">
                        <div class="relative h-[310px] overflow-hidden rounded-3xl">
                            <div class="absolute inset-0 z-10 flex flex-col justify-end gap-2 card-ol p-4">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <span class="text-[10px] font-bold rounded-full px-2 py-0.5 text-black"
                                            style="background:var(--gold);">{{ $paket->durasi }}</span>
                                        <h3 class="text-[15px] font-bold text-white mt-1">{{ $paket->nama_paket }}</h3>
                                        <p class="text-sm font-semibold" style="color:#f0c94d;">Rp
                                            {{ number_format($paket->harga_paket, 0, ',', '.') }}<span
                                                class="text-white font-normal text-xs">/pax</span></p>
                                    </div>
                                </div>
                            </div>
                            @if ($paket->fotos && $paket->fotos->count() > 0)
                                @php $firstFoto = $paket->fotos->first(); @endphp
                                <img src="{{ Str::startsWith($firstFoto->path, 'http') ? $firstFoto->path : asset('storage/' . $firstFoto->path) }}"
                                    alt="{{ $paket->nama_paket }}" class="h-full w-full object-cover" />
                            @else
                                <div class="h-full w-full" style="background:linear-gradient(135deg,#7c3f00,#c97a1a);">
                                </div>
                            @endif
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 text-center py-10">
                        <p class="tm">Tidak ada paket wisata yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>
            <p class="text-center text-xs tm fade-in">* Harga dapat berubah sewaktu-waktu. Hubungi kami untuk negosiasi
                sesuai kebutuhan rombongan.</p>
        </div>
    </section>


    <!-- ===== GALERI ===== -->
    <section id="galeri" class="mx-auto mt-24 max-w-[1280px] space-y-7 px-14 fade-in">
        <div class="flex items-end justify-between">
            <div>
                <span class="font-semibold text-sm uppercase tracking-widest"
                    style="color:var(--gold);">Dokumentasi</span>
                <h2 class="text-[28px] font-bold t mt-1">Galeri Tour</h2>
                <p class="tm">Kenangan indah bersama ratusan peserta wisata kami</p>
            </div>
            <a href="{{ route('photos') }}" class="btn btn-gold">Semua Foto</a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            @forelse($fotos as $index => $foto)
                <div class="galeri-item h-[185px] flex items-center justify-center flex-col gap-1 text-white/60 relative"
                    style="@if ($index % 5 == 0) background:linear-gradient(135deg,#7c3f00,#c97a1a); @elseif($index % 5 == 1) background:linear-gradient(135deg,#1e3a8a,#0369a1); @elseif($index % 5 == 2) background:linear-gradient(135deg,#78350f,#d97706); @elseif($index % 5 == 3) background:linear-gradient(135deg,#134e4a,#0d9488); @else background:linear-gradient(135deg,#3b0764,#6d28d9); @endif">
                    @if ($foto->path)
                        <img src="{{ Str::startsWith($foto->path, 'http') ? $foto->path : asset('storage/' . $foto->path) }}" alt="{{ $foto->keterangan ?? 'Galeri' }}"
                            class="absolute inset-0 w-full h-full object-cover" />
                    @else
                        <svg class="w-8 h-8 text-white/30" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z" />
                        </svg>
                    @endif
                    @if ($foto->keterangan)
                        <p class="text-xs font-medium absolute bottom-2 left-2 right-2 text-center text-white">
                            {{ $foto->keterangan }}</p>
                    @endif
                </div>
            @empty
                <div class="col-span-4 text-center py-10">
                    <p class="tm">Tidak ada foto galeri yang tersedia saat ini.</p>
                </div>
            @endforelse
        </div>
    </section>
@endsection
