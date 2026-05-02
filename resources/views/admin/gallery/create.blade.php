@extends('components.layout.admin')
@section('title', 'Upload Media Galeri')
@section('header', 'Upload Media Galeri')

@section('content')
    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="max-w-3xl space-y-6">
        @csrf

        {{-- Upload Area --}}
        <div class="bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800">
            <div class="p-4 lg:p-6 border-b border-neutral-200 dark:border-neutral-800 flex items-center gap-3">
                <a href="{{ route('admin.gallery.index') }}"
                    class="p-2 rounded-lg text-neutral-400 hover:text-neutral-600 dark:hover:text-neutral-200 hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <h3 class="text-lg font-semibold">Upload Media</h3>
            </div>
            <div class="p-4 lg:p-6">
                {{-- Dropzone --}}
                <div id="dropzone"
                    class="flex flex-col items-center justify-center w-full h-48 border-2 border-neutral-300 dark:border-neutral-700 border-dashed rounded-xl cursor-pointer bg-neutral-50 dark:bg-neutral-800 hover:bg-neutral-100 dark:hover:bg-neutral-700 transition-colors"
                    onclick="document.getElementById('media').click()"
                    ondragover="event.preventDefault(); this.classList.add('border-amber-500','bg-amber-50')"
                    ondragleave="this.classList.remove('border-amber-500','bg-amber-50')" ondrop="handleDrop(event)">
                    <svg class="w-10 h-10 mb-3 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="text-sm font-medium text-neutral-600 dark:text-neutral-300">Klik atau drag & drop file di sini</p>
                    <p class="text-xs text-neutral-400 mt-1">Foto (JPG, PNG, GIF, SVG, WebP) & Video (MP4, MOV, AVI) — Maks. 50MB per file</p>
                </div>
                <input type="file" name="media[]" id="media" multiple accept="image/*,video/*" class="hidden"
                    onchange="previewMedia(this)">

                @error('media')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
                @error('media.*')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror

                {{-- Preview Grid --}}
                <div id="preview-grid" class="grid grid-cols-3 sm:grid-cols-4 gap-3 mt-4"></div>
            </div>
        </div>

        {{-- Relasi --}}
        <div class="bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800">
            <div class="p-4 lg:p-6 border-b border-neutral-200 dark:border-neutral-800">
                <h3 class="text-lg font-semibold">Relasi Media</h3>
                <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">Kaitkan media dengan paket, tempat wisata, atau fasilitas</p>
            </div>
            <div class="p-4 lg:p-6 space-y-4">
                {{-- Pilih Paket --}}
                <div>
                    <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">Paket Tour <span class="text-xs text-neutral-400">(pilih dulu untuk filter tempat/fasilitas)</span></label>
                    <select id="paketSelect"
                        class="w-full px-4 py-2.5 rounded-lg border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-neutral-100 focus:ring-2 focus:ring-amber-500 transition-colors">
                        <option value="">-- Pilih Paket --</option>
                        @foreach ($pakets as $paket)
                            <option value="{{ $paket->id }}">{{ $paket->nama_paket }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- Pilih Tempat --}}
                    <div>
                        <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">Tempat Wisata</label>
                        <select name="id_tempat" id="tempatSelect" disabled
                            class="w-full px-4 py-2.5 rounded-lg border border-neutral-300 dark:border-neutral-700 bg-neutral-100 dark:bg-neutral-800 text-neutral-900 dark:text-neutral-100 focus:ring-2 focus:ring-amber-500 transition-colors disabled:opacity-50">
                            <option value="">-- Pilih paket terlebih dahulu --</option>
                        </select>
                        @error('id_tempat')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- Pilih Fasilitas --}}
                    <div>
                        <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">Fasilitas <span class="text-xs text-neutral-400">(opsional)</span></label>
                        <select name="id_fasilitas" id="fasilitasSelect" disabled
                            class="w-full px-4 py-2.5 rounded-lg border border-neutral-300 dark:border-neutral-700 bg-neutral-100 dark:bg-neutral-800 text-neutral-900 dark:text-neutral-100 focus:ring-2 focus:ring-amber-500 transition-colors disabled:opacity-50">
                            <option value="">-- Pilih paket terlebih dahulu --</option>
                        </select>
                        @error('id_fasilitas')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.gallery.index') }}"
                class="px-5 py-2.5 text-sm font-medium text-neutral-700 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-800 rounded-lg transition-colors">Batal</a>
            <button type="submit"
                class="px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-lg transition-colors">
                Upload Media
            </button>
        </div>
    </form>

    <script>
        // === Dependent Dropdown via AJAX ===
        const paketSelect = document.getElementById('paketSelect');
        const tempatSelect = document.getElementById('tempatSelect');
        const fasilitasSelect = document.getElementById('fasilitasSelect');

        paketSelect.addEventListener('change', async function() {
            const paketId = this.value;

            // Reset dropdowns
            tempatSelect.innerHTML = '<option value="">-- Tidak dikaitkan --</option>';
            fasilitasSelect.innerHTML = '<option value="">-- Tidak dikaitkan --</option>';

            if (!paketId) {
                tempatSelect.disabled = true;
                fasilitasSelect.disabled = true;
                tempatSelect.classList.add('opacity-50');
                fasilitasSelect.classList.add('opacity-50');
                return;
            }

            try {
                const res = await fetch(`{{ url('admin/api/gallery/relations') }}?paket_id=${paketId}`);
                const data = await res.json();

                // Populate Tempat
                data.tempats.forEach(t => {
                    const opt = document.createElement('option');
                    opt.value = t.id;
                    opt.textContent = t.nama;
                    tempatSelect.appendChild(opt);
                });

                // Populate Fasilitas
                data.fasilitas.forEach(f => {
                    const opt = document.createElement('option');
                    opt.value = f.id;
                    opt.textContent = f.nama;
                    fasilitasSelect.appendChild(opt);
                });

                tempatSelect.disabled = false;
                fasilitasSelect.disabled = false;
                tempatSelect.classList.remove('opacity-50');
                fasilitasSelect.classList.remove('opacity-50');
            } catch (err) {
                console.error('Failed to load relations:', err);
            }
        });

        // === Preview Media ===
        function previewMedia(input) {
            const grid = document.getElementById('preview-grid');
            grid.innerHTML = '';
            let imgCount = 0, vidCount = 0;

            Array.from(input.files).forEach(file => {
                const div = document.createElement('div');
                div.className = 'relative aspect-square rounded-lg overflow-hidden border border-neutral-200 dark:border-neutral-700';

                if (file.type.startsWith('image/')) {
                    imgCount++;
                    const reader = new FileReader();
                    reader.onload = e => {
                        div.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                        grid.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                } else if (file.type.startsWith('video/')) {
                    vidCount++;
                    div.innerHTML = `
                        <div class="w-full h-full bg-neutral-800 flex flex-col items-center justify-center gap-2">
                            <svg class="w-10 h-10 text-amber-500" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            <p class="text-xs text-neutral-400 px-2 text-center truncate">${file.name}</p>
                        </div>`;
                    grid.appendChild(div);
                }
            });

            if (input.files.length > 0) {
                const parts = [];
                if (imgCount > 0) parts.push(`${imgCount} foto`);
                if (vidCount > 0) parts.push(`${vidCount} video`);

                document.getElementById('dropzone').innerHTML = `
                    <svg class="w-8 h-8 mb-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <p class="text-sm font-medium text-amber-600">${parts.join(' & ')} dipilih</p>
                    <p class="text-xs text-neutral-400 mt-1">Klik untuk mengganti</p>
                `;
            }
        }

        function handleDrop(event) {
            event.preventDefault();
            event.currentTarget.classList.remove('border-amber-500', 'bg-amber-50');
            const input = document.getElementById('media');
            const dt = event.dataTransfer;
            Object.defineProperty(input, 'files', { value: dt.files, writable: true });
            previewMedia({ files: dt.files });
        }
    </script>
@endsection
