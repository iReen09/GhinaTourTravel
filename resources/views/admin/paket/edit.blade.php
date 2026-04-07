<script>
    function addField(containerId, placeholder, name) {
        const container = document.getElementById(containerId);
        const wrapper = document.createElement('div');
        wrapper.className = 'dynamic-field flex items-center gap-2 mb-2';
        wrapper.innerHTML = `
            <input type="text" name="${name}[]" placeholder="${placeholder}"
                class="flex-1 px-3 py-2 rounded-lg border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-neutral-100 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors">
            <button type="button" onclick="removeField(this)" class="p-2 rounded-lg text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        `;
        container.appendChild(wrapper);
    }

    function removeField(btn) {
        btn.closest('.dynamic-field').remove();
    }

    // Photo input functionality
    function addPhotoInput() {
        const container = document.getElementById('foto-inputs-container');
        const wrapper = document.createElement('div');
        wrapper.className = 'relative mt-2';
        wrapper.innerHTML = `
            <div class="flex items-center justify-center w-full">
                <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-neutral-300 dark:border-neutral-700 border-dashed rounded-lg cursor-pointer bg-neutral-50 dark:bg-neutral-800 hover:bg-neutral-100 dark:hover:bg-neutral-700 transition-colors">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-2 text-neutral-500 dark:text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-sm text-neutral-500 dark:text-neutral-400">Klik untuk memilih foto</p>
                    </div>
                    <input name="fotos[]" type="file" class="hidden foto-input" accept="image/*" onchange="previewPhotos(this)">
                </label>
            </div>
            <button type="button" onclick="this.parentElement.remove(); updatePreviews();" class="absolute -top-2 -right-2 p-1 bg-red-500 text-white rounded-full hover:bg-red-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        `;
        container.appendChild(wrapper);
        wrapper.querySelector('input').click();
    }

    function previewPhotos(input) {
        const fotoPreview = document.getElementById('foto-preview');
        
        Array.from(input.files).forEach((file) => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const div = document.createElement('div');
                    div.className = 'relative group';
                    div.innerHTML = `
                        <img src="${event.target.result}" class="w-full h-24 object-cover rounded-lg border border-neutral-200 dark:border-neutral-700">
                        <button type="button" onclick="removePhoto(this, '${event.target.result}')" class="absolute -top-2 -right-2 p-1 bg-red-500 text-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    `;
                    fotoPreview.appendChild(div);
                };
                reader.readAsDataURL(file);
            }
        });
    }

    function removePhoto(btn, dataUrl) {
        btn.closest('div').remove();
        // Clear the corresponding input
        document.querySelectorAll('.foto-input').forEach(input => {
            input.value = '';
        });
    }

    function updatePreviews() {
        // Re-render previews from all inputs
        const fotoPreview = document.getElementById('foto-preview');
        fotoPreview.innerHTML = '';
        document.querySelectorAll('.foto-input').forEach(input => {
            Array.from(input.files).forEach((file) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        const div = document.createElement('div');
                        div.className = 'relative group';
                        div.innerHTML = `
                            <img src="${event.target.result}" class="w-full h-24 object-cover rounded-lg border border-neutral-200 dark:border-neutral-700">
                            <button type="button" onclick="removePhoto(this, '${event.target.result}')" class="absolute -top-2 -right-2 p-1 bg-red-500 text-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        `;
                        fotoPreview.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    }
</script>

@extends('admin.layouts.app')

@section('title', 'Edit Paket Tour')
@section('header', 'Edit Paket Tour')

@section('content')
<form action="{{ route('admin.paket.update', $paket->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')

    <div class="bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800">
        <div class="p-4 lg:p-6 border-b border-neutral-200 dark:border-neutral-800">
            <h3 class="text-lg font-semibold">Informasi Paket</h3>
            <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">Nama paket dan harga</p>
        </div>
        <div class="p-4 lg:p-6 space-y-4">
            <div>
                <label for="nama_paket" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                    Nama Paket <span class="text-red-500">*</span>
                </label>
                <input type="text" id="nama_paket" name="nama_paket" value="{{ old('nama_paket', $paket->nama_paket) }}" required
                    class="w-full px-4 py-2.5 rounded-lg border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-neutral-100 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors @error('nama_paket') border-red-500 @enderror"
                    placeholder="Contoh: Paket Umroh Premium 9 Hari">
                @error('nama_paket')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <label for="harga_paket" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                        Harga Paket (Rp) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-neutral-500">Rp</span>
                        <input type="number" id="harga_paket" name="harga_paket" value="{{ old('harga_paket', $paket->harga_paket) }}" required min="0" step="1000"
                            class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-neutral-100 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors @error('harga_paket') border-red-500 @enderror"
                            placeholder="0">
                    </div>
                    @error('harga_paket')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="note" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                    Catatan / Deskripsi
                </label>
                <textarea id="note" name="note" rows="3"
                    class="w-full px-4 py-2.5 rounded-lg border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-neutral-100 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors resize-none @error('note') border-red-500 @enderror"
                    placeholder="Tambahkan deskripsi atau catatan tambahan...">{{ old('note', $paket->note) }}</textarea>
                @error('note')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800">
        <div class="p-4 lg:p-6 border-b border-neutral-200 dark:border-neutral-800">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-pink-600 dark:text-pink-400">Foto Paket</h3>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">Unggah foto untuk paket tour</p>
                </div>
                <button type="button" onclick="addPhotoInput()" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium text-pink-600 dark:text-pink-400 hover:bg-pink-50 dark:hover:bg-pink-900/20 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Foto
                </button>
            </div>
        </div>
        <div class="p-4 lg:p-6 space-y-4">
            @if($paket->fotos->count() > 0)
            <div>
                <p class="text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">Foto Saat Ini ({{ $paket->fotos->count() }})</p>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    @foreach($paket->fotos as $foto)
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $foto->path) }}" class="w-full h-24 object-cover rounded-lg border border-neutral-200 dark:border-neutral-700">
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
            
            <div id="foto-inputs-container">
                <div class="flex items-center justify-center w-full">
                    <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-neutral-300 dark:border-neutral-700 border-dashed rounded-lg cursor-pointer bg-neutral-50 dark:bg-neutral-800 hover:bg-neutral-100 dark:hover:bg-neutral-700 transition-colors">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-2 text-neutral-500 dark:text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-sm text-neutral-500 dark:text-neutral-400">Klik untuk memilih foto baru</p>
                            <p class="text-xs text-neutral-400 dark:text-neutral-500 mt-1">Maks 2MB per foto</p>
                        </div>
                        <input name="fotos[]" type="file" class="hidden foto-input" accept="image/*" onchange="previewPhotos(this)">
                    </label>
                </div>
            </div>
            @error('fotos')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
            
            <div id="foto-preview" class="mt-4 grid grid-cols-2 sm:grid-cols-4 gap-4"></div>
        </div>
    </div>

    <div class="bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800">
        <div class="p-4 lg:p-6 border-b border-neutral-200 dark:border-neutral-800">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold">Tempat Wisata</h3>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">Daftar tempat yang dikunjungi</p>
                </div>
                <button type="button" onclick="addField('tempats-container', 'Nama tempat wisata', 'tempats')"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah
                </button>
            </div>
        </div>
        <div class="p-4 lg:p-6">
            <div id="tempats-container" class="space-y-2">
                @foreach($paket->tempats as $tempat)
                    <div class="dynamic-field flex items-center gap-2 mb-2">
                        <input type="text" name="tempats[]" value="{{ $tempat->nama_tempat }}"
                            class="flex-1 px-3 py-2 rounded-lg border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-neutral-100 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors">
                        <button type="button" onclick="removeField(this)" class="p-2 rounded-lg text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800">
        <div class="p-4 lg:p-6 border-b border-neutral-200 dark:border-neutral-800">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold">Konsumsi</h3>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">Fasilitas makan & minum</p>
                </div>
                <button type="button" onclick="addField('konsumsis-container', 'Contoh: Makan 3x sehari', 'konsumsis')"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-green-900/20 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah
                </button>
            </div>
        </div>
        <div class="p-4 lg:p-6">
            <div id="konsumsis-container" class="space-y-2">
                @foreach($paket->konsumsis as $konsumsi)
                    <div class="dynamic-field flex items-center gap-2 mb-2">
                        <input type="text" name="konsumsis[]" value="{{ $konsumsi->fasilitas_konsumsi }}"
                            class="flex-1 px-3 py-2 rounded-lg border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-neutral-100 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors">
                        <button type="button" onclick="removeField(this)" class="p-2 rounded-lg text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800">
        <div class="p-4 lg:p-6 border-b border-neutral-200 dark:border-neutral-800">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold">Akomodasi</h3>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">Penginapan & hotel</p>
                </div>
                <button type="button" onclick="addField('akomodasis-container', 'Contoh: Hotel Bintang 4', 'akomodasis')"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium text-purple-600 dark:text-purple-400 hover:bg-purple-50 dark:hover:bg-purple-900/20 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah
                </button>
            </div>
        </div>
        <div class="p-4 lg:p-6">
            <div id="akomodasis-container" class="space-y-2">
                @foreach($paket->akomodasis as $akomodasi)
                    <div class="dynamic-field flex items-center gap-2 mb-2">
                        <input type="text" name="akomodasis[]" value="{{ $akomodasi->fasilitas_akomodasi }}"
                            class="flex-1 px-3 py-2 rounded-lg border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-neutral-100 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors">
                        <button type="button" onclick="removeField(this)" class="p-2 rounded-lg text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800">
        <div class="p-4 lg:p-6 border-b border-neutral-200 dark:border-neutral-800">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold">Transportasi</h3>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">Kendaraan & perjalanan</p>
                </div>
                <button type="button" onclick="addField('transportasis-container', 'Contoh: Bus AC Premium', 'transportasis')"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium text-orange-600 dark:text-orange-400 hover:bg-orange-50 dark:hover:bg-orange-900/20 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah
                </button>
            </div>
        </div>
        <div class="p-4 lg:p-6">
            <div id="transportasis-container" class="space-y-2">
                @foreach($paket->transportasis as $transportasi)
                    <div class="dynamic-field flex items-center gap-2 mb-2">
                        <input type="text" name="transportasis[]" value="{{ $transportasi->fasilitas_transportasi }}"
                            class="flex-1 px-3 py-2 rounded-lg border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-neutral-100 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors">
                        <button type="button" onclick="removeField(this)" class="p-2 rounded-lg text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="flex items-center justify-end gap-3">
        <a href="{{ route('admin.paket.index') }}" class="px-5 py-2.5 text-sm font-medium text-neutral-700 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-800 rounded-lg transition-colors">
            Batal
        </a>
        <button type="submit" class="px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-lg transition-colors">
            Perbarui Paket
        </button>
    </div>
</form>
@endsection
