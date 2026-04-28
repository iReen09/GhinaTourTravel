@extends('components.layout.admin')
@section('title', 'Edit Pesanan')
@section('header', 'Edit Pesanan')

@section('content')
    {{-- $id = Pesanan model (sesuai variable yang dipass dari controller) --}}
    <form action="{{ route('admin.pesanan.update', $id->id) }}" method="POST" class="max-w-3xl space-y-6">
        @csrf
        @method('PUT')

        {{-- Pilih Paket --}}
        <div class="bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800">
            <div class="p-4 lg:p-6 border-b border-neutral-200 dark:border-neutral-800 flex items-center gap-3">
                <a href="{{ route('admin.pesanan.index') }}"
                    class="p-2 rounded-lg text-neutral-400 hover:text-neutral-600 dark:hover:text-neutral-200 hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div>
                    <h3 class="text-lg font-semibold">Edit Pesanan</h3>
                    <p class="text-sm text-neutral-500 font-mono">{{ $id->invoice }}</p>
                </div>
            </div>
            <div class="p-4 lg:p-6">
                <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                    Paket Wisata <span class="text-red-500">*</span>
                </label>
                <select name="id_paket" id="id_paket" required onchange="updateHargaPaket(this)"
                    class="w-full px-4 py-2.5 rounded-lg border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-neutral-100 focus:ring-2 focus:ring-amber-500 transition-colors">
                    <option value="">-- Pilih Paket --</option>
                    @foreach ($pakets as $pk)
                        <option value="{{ $pk->id }}" data-harga="{{ $pk->harga_paket }}"
                            {{ old('id_paket', $id->id_paket) == $pk->id ? 'selected' : '' }}>
                            {{ $pk->nama_paket }} — Rp {{ number_format($pk->harga_paket, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
                @error('id_paket')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Data Pemesan --}}
        <div class="bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800">
            <div class="p-4 lg:p-6 border-b border-neutral-200 dark:border-neutral-800">
                <h3 class="text-lg font-semibold">Data Pemesan</h3>
            </div>
            <div class="p-4 lg:p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                        Nama Perwakilan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_pemesan" value="{{ old('nama_pemesan', $id->nama_pemesan) }}" required
                        class="w-full px-4 py-2.5 rounded-lg border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 focus:ring-2 focus:ring-amber-500 transition-colors">
                    @error('nama_pemesan')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                        No. HP <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $id->no_hp) }}" required
                        class="w-full px-4 py-2.5 rounded-lg border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 focus:ring-2 focus:ring-amber-500 transition-colors">
                    @error('no_hp')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                        Tanggal Acara <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="tanggal_acara"
                        value="{{ old('tanggal_acara', \Carbon\Carbon::parse($id->tanggal_acara)->format('Y-m-d')) }}"
                        required
                        class="w-full px-4 py-2.5 rounded-lg border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 focus:ring-2 focus:ring-amber-500 transition-colors">
                    @error('tanggal_acara')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                        Pax <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="jumlah_orang" id="jumlah_orang"
                        value="{{ old('jumlah_orang', $id->jumlah_orang) }}" required min="1"
                        class="w-full px-4 py-2.5 rounded-lg border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 focus:ring-2 focus:ring-amber-500 transition-colors"
                        oninput="hitungTotal()">
                    @error('jumlah_orang')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Harga & Status --}}
        <div class="bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800">
            <div class="p-4 lg:p-6 border-b border-neutral-200 dark:border-neutral-800">
                <h3 class="text-lg font-semibold">Harga, Diskon & Status</h3>
            </div>
            <div class="p-4 lg:p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">Diskon (%)</label>
                    <input type="number" name="diskon" id="diskon" value="{{ old('diskon', $id->diskon) }}"
                        min="0" max="100"
                        class="w-full px-4 py-2.5 rounded-lg border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 focus:ring-2 focus:ring-amber-500 transition-colors"
                        oninput="hitungTotal()">
                    @error('diskon')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                        Total Harga <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="total_harga" id="total_harga"
                        value="{{ old('total_harga', $id->total_harga) }}" required min="0"
                        class="w-full px-4 py-2.5 rounded-lg border border-neutral-300 dark:border-neutral-700 bg-neutral-100 dark:bg-neutral-700 focus:ring-2 focus:ring-amber-500 transition-colors"
                        readonly>
                    @error('total_harga')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="sm:col-span-2">
                    <div class="bg-green-50 dark:bg-green-900/20 rounded-xl p-4 flex items-center justify-between mb-4">
                        <span class="font-semibold text-green-700 dark:text-green-400">Total Setelah Diskon</span>
                        <span id="total-akhir" class="text-xl font-bold text-green-700 dark:text-green-400">
                            Rp {{ number_format($id->total_harga, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">Status
                        Pesanan</label>
                    <select name="status"
                        class="w-full px-4 py-2.5 rounded-lg border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 focus:ring-2 focus:ring-amber-500 transition-colors">
                        <option value="pending" {{ old('status', $id->status) === 'pending' ? 'selected' : '' }}>Pending
                        </option>
                        <option value="selesai" {{ old('status', $id->status) === 'selesai' ? 'selected' : '' }}>Selesai
                        </option>
                        <option value="batal" {{ old('status', $id->status) === 'batal' ? 'selected' : '' }}>Batal
                        </option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.pesanan.index') }}"
                class="px-5 py-2.5 text-sm font-medium text-neutral-700 hover:bg-neutral-100 rounded-lg transition-colors">Batal</a>
            <button type="submit"
                class="px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-lg transition-colors">
                Update Pesanan
            </button>
        </div>
    </form>

    <script>
        let hargaPerOrang = 0;

        function updateHargaPaket(sel) {
            const opt = sel.options[sel.selectedIndex];
            hargaPerOrang = parseFloat(opt.dataset.harga) || 0;
            hitungTotal();
        }

        function hitungTotal() {
            const orang = parseInt(document.getElementById('jumlah_orang').value) || 0;
            const diskon = parseFloat(document.getElementById('diskon').value) || 0;
            const subtotal = hargaPerOrang * orang;
            const total = Math.round(subtotal * (1 - diskon / 100));

            document.getElementById('total_harga').value = total;
            document.getElementById('total-akhir').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const sel = document.getElementById('id_paket');
            if (sel && sel.value) updateHargaPaket(sel);
        });
    </script>
@endsection
