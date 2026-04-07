@extends('admin.layouts.app')

@section('title', 'Detail Paket Tour')
@section('header', 'Detail Paket Tour')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 overflow-hidden">
        <div class="p-4 lg:p-6 border-b border-neutral-200 dark:border-neutral-800 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.paket.index') }}" class="p-2 rounded-lg text-neutral-400 hover:text-neutral-600 dark:hover:text-neutral-200 hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <div>
                    <h3 class="text-lg font-semibold">Detail Paket Tour</h3>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400">Informasi lengkap paket</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.paket.edit', $paket->id) }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-amber-600 dark:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-900/20 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
            </div>
        </div>

        <div class="p-4 lg:p-6">
            <div class="flex items-start gap-4">
                <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-amber-100 to-orange-100 dark:from-amber-900/30 dark:to-orange-900/30 flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="text-xl font-bold text-neutral-900 dark:text-neutral-100">{{ $paket->nama_paket }}</h4>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">ID: #{{ str_pad($paket->id, 4, '0', STR_PAD_LEFT) }}</p>
                </div>
            </div>
        </div>

        <div class="px-4 lg:px-6 pb-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="bg-green-50 dark:bg-green-900/20 rounded-xl p-4">
                    <p class="text-sm text-green-600 dark:text-green-400 font-medium">Harga Paket</p>
                    <p class="text-xl font-bold text-green-700 dark:text-green-300 mt-1">
                        Rp {{ number_format($paket->harga_paket, 0, ',', '.') }}
                    </p>
                </div>
                <div class="bg-neutral-50 dark:bg-neutral-800 rounded-xl p-4">
                    <p class="text-sm text-neutral-500 dark:text-neutral-400 font-medium">Tanggal Dibuat</p>
                    <p class="text-lg font-bold text-neutral-900 dark:text-neutral-100 mt-1">
                        {{ $paket->created_at->format('d M Y') }}
                    </p>
                </div>
            </div>
        </div>

        @if($paket->note)
        <div class="px-4 lg:px-6 pb-4">
            <div class="bg-amber-50 dark:bg-amber-900/20 rounded-xl p-4">
                <p class="text-sm font-medium text-amber-700 dark:text-amber-400 mb-1">Catatan</p>
                <p class="text-neutral-700 dark:text-neutral-300 text-sm leading-relaxed">{{ $paket->note }}</p>
            </div>
        </div>
        @endif

        @if($paket->fotos->count() > 0)
        <div class="px-4 lg:px-6 pb-4">
            <div class="bg-pink-50 dark:bg-pink-900/20 rounded-xl p-4">
                <div class="flex items-center gap-2 mb-3">
                    <svg class="w-5 h-5 text-pink-600 dark:text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-sm font-semibold text-pink-700 dark:text-pink-300">Foto Paket ({{ $paket->fotos->count() }})</p>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                    @foreach($paket->fotos as $foto)
                        <a href="{{ asset('storage/' . $foto->path) }}" target="_blank" class="block rounded-lg overflow-hidden hover:opacity-90 transition-opacity">
                            <img src="{{ asset('storage/' . $foto->path) }}" class="w-full h-28 object-cover">
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <div class="px-4 lg:px-6 pb-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @if($paket->tempats->count() > 0)
                <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-4">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <p class="text-sm font-semibold text-blue-700 dark:text-blue-300">Tempat ({{ $paket->tempats->count() }})</p>
                    </div>
                    <ul class="space-y-1">
                        @foreach($paket->tempats as $tempat)
                            <li class="text-sm text-blue-600 dark:text-blue-400 truncate">{{ $tempat->nama_tempat }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if($paket->konsumsis->count() > 0)
                <div class="bg-green-50 dark:bg-green-900/20 rounded-xl p-4">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <p class="text-sm font-semibold text-green-700 dark:text-green-300">Konsumsi ({{ $paket->konsumsis->count() }})</p>
                    </div>
                    <ul class="space-y-1">
                        @foreach($paket->konsumsis as $konsumsi)
                            <li class="text-sm text-green-600 dark:text-green-400 truncate">{{ $konsumsi->fasilitas_konsumsi }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if($paket->akomodasis->count() > 0)
                <div class="bg-purple-50 dark:bg-purple-900/20 rounded-xl p-4">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <p class="text-sm font-semibold text-purple-700 dark:text-purple-300">Akomodasi ({{ $paket->akomodasis->count() }})</p>
                    </div>
                    <ul class="space-y-1">
                        @foreach($paket->akomodasis as $akomodasi)
                            <li class="text-sm text-purple-600 dark:text-purple-400 truncate">{{ $akomodasi->fasilitas_akomodasi }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if($paket->transportasis->count() > 0)
                <div class="bg-orange-50 dark:bg-orange-900/20 rounded-xl p-4">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                        </svg>
                        <p class="text-sm font-semibold text-orange-700 dark:text-orange-300">Transportasi ({{ $paket->transportasis->count() }})</p>
                    </div>
                    <ul class="space-y-1">
                        @foreach($paket->transportasis as $transportasi)
                            <li class="text-sm text-orange-600 dark:text-orange-400 truncate">{{ $transportasi->fasilitas_transportasi }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>

        @if($paket->tempats->count() === 0 && $paket->konsumsis->count() === 0 && $paket->akomodasis->count() === 0 && $paket->transportasis->count() === 0)
        <div class="px-4 lg:px-6 pb-4">
            <div class="bg-neutral-50 dark:bg-neutral-800 rounded-xl p-6 text-center">
                <p class="text-neutral-500 dark:text-neutral-400">Belum ada komponen yang ditambahkan</p>
            </div>
        </div>
        @endif

        <div class="px-4 lg:px-6 py-4 border-t border-neutral-200 dark:border-neutral-800 bg-neutral-50 dark:bg-neutral-800/50">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div class="flex items-center gap-2 text-sm text-neutral-500 dark:text-neutral-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Dibuat: {{ $paket->created_at->format('d M Y, H:i') }}
                    <span class="hidden sm:inline mx-2">•</span>
                    <span class="hidden sm:inline">Diperbarui: {{ $paket->updated_at->format('d M Y, H:i') }}</span>
                </div>
                <form action="{{ route('admin.paket.destroy', $paket->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus paket ini? Semua data terkait akan ikut terhapus.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus Paket
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
