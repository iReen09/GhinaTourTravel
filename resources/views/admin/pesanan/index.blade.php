@extends('components.layout.admin')
@section('title', 'Daftar Pesanan')
@section('header', 'Daftar Pesanan')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Pesanan</h1>
        <a href="{{ route('admin.pesanan.create') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-lg transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Pesanan
        </a>
    </div>

    <div class="bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-neutral-50 dark:bg-neutral-800">
                        <th
                            class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 uppercase tracking-wider border-b border-neutral-200 dark:border-neutral-700">
                            Invoice</th>
                        <th
                            class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 uppercase tracking-wider border-b border-neutral-200 dark:border-neutral-700">
                            Pemesan</th>
                        <th
                            class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 uppercase tracking-wider border-b border-neutral-200 dark:border-neutral-700">
                            Paket</th>
                        <th
                            class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 uppercase tracking-wider border-b border-neutral-200 dark:border-neutral-700">
                            Tanggal Acara</th>
                        <th
                            class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 uppercase tracking-wider border-b border-neutral-200 dark:border-neutral-700">
                            Pax</th>
                        <th
                            class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 uppercase tracking-wider border-b border-neutral-200 dark:border-neutral-700">
                            Total</th>
                        <th
                            class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 uppercase tracking-wider border-b border-neutral-200 dark:border-neutral-700">
                            Status</th>
                        <th
                            class="px-4 py-3 text-center text-xs font-semibold text-neutral-500 uppercase tracking-wider border-b border-neutral-200 dark:border-neutral-700">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesanans as $p)
                        <tr
                            class="border-b border-neutral-100 dark:border-neutral-800 hover:bg-neutral-50 dark:hover:bg-neutral-800/50">
                            <td class="px-4 py-3 text-sm font-mono text-purple-600">{{ $p->invoice }}</td>
                            <td class="px-4 py-3">
                                <div class="font-medium text-sm">{{ $p->nama_pemesan }}</div>
                                <div class="text-xs text-neutral-400">{{ $p->no_hp }}</div>
                            </td>
                            <td class="px-4 py-3 text-sm">{{ $p->paket->nama_paket ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm">{{ \Carbon\Carbon::parse($p->tanggal_acara)->format('d M Y') }}
                            </td>
                            <td class="px-4 py-3 text-sm">{{ $p->jumlah_orang ?? '-' }} pax</td>
                            <td class="px-4 py-3 text-sm">
                                @if ($p->diskon > 0)
                                    @php
                                        $originalPrice = ($p->paket->harga_paket ?? 0) * ($p->jumlah_orang ?? 0);
                                    @endphp
                                    <div class="text-xs text-neutral-400 line-through">
                                        Rp {{ number_format($originalPrice, 0, ',', '.') }}
                                    </div>
                                @endif
                                <div class="font-semibold text-green-700">
                                    Rp {{ number_format($p->total_harga, 0, ',', '.') }}
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <span
                                    class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold
                                    {{ $p->status === 'selesai'
                                        ? 'bg-green-100 text-green-700'
                                        : ($p->status === 'batal'
                                            ? 'bg-red-100 text-red-700'
                                            : 'bg-yellow-100 text-yellow-700') }}">
                                    {{ ucfirst($p->status ?? 'pending') }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex items-center justify-center gap-1">
                                    <a href="{{ route('admin.pesanan.show', $p->id) }}"
                                        class="p-1.5 text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.pesanan.edit', $p->id) }}"
                                        class="p-1.5 text-amber-500 hover:bg-amber-50 dark:hover:bg-amber-900/20 rounded-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.pesanan.destroy', $p->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus pesanan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="p-1.5 text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-10 text-center text-neutral-400">Belum ada pesanan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($pesanans->hasPages())
            <div class="px-4 py-4 border-t border-neutral-200 dark:border-neutral-700">
                {{ $pesanans->links() }}
            </div>
        @endif
    </div>
@endsection
