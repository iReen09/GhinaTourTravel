@extends('components.layout.admin')

@section('title', 'Edit Company Profile')
@section('header', 'Edit Company Profile')

@section('content')
    <div class="max-w-3xl">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Edit Company Profile</h1>
            <a href="{{ route('admin.company-profile.show') }}"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium text-neutral-600 dark:text-neutral-400 hover:bg-neutral-100 dark:hover:bg-neutral-800 border border-neutral-200 dark:border-neutral-700 transition-colors">
                ← Kembali
            </a>
        </div>

        <form action="{{ route('admin.company-profile.update', $companyProfile->id ?? 1) }}" method="POST"
            class="bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 overflow-hidden">
            @csrf
            @method('PUT')

            <div class="p-6 space-y-6">
                {{-- About --}}
                <div>
                    <label for="about" class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300 mb-2">
                        Tentang Perusahaan <span class="text-red-500">*</span>
                    </label>
                    <textarea id="about" name="about" rows="4" required
                        class="w-full rounded-lg border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-neutral-100 px-4 py-3 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition-colors">{{ old('about', $companyProfile->about ?? '') }}</textarea>
                </div>

                {{-- Vision & Mission --}}
                <div>
                    <label for="vision_mission" class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300 mb-2">
                        Visi & Misi
                    </label>
                    <textarea id="vision_mission" name="vision_mission" rows="4"
                        class="w-full rounded-lg border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-neutral-100 px-4 py-3 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition-colors">{{ old('vision_mission', $companyProfile->vision_mission ?? '') }}</textarea>
                </div>

                {{-- Address --}}
                <div>
                    <label for="address" class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300 mb-2">
                        Alamat
                    </label>
                    <textarea id="address" name="address" rows="2"
                        class="w-full rounded-lg border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-neutral-100 px-4 py-3 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition-colors">{{ old('address', $companyProfile->address ?? '') }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    {{-- WhatsApp --}}
                    <div>
                        <label for="whatsapp" class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300 mb-2">
                            WhatsApp
                        </label>
                        <input type="text" id="whatsapp" name="whatsapp" placeholder="081234567890"
                            value="{{ old('whatsapp', $companyProfile->whatsapp ?? '') }}"
                            class="w-full rounded-lg border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-neutral-100 px-4 py-3 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition-colors" />
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300 mb-2">
                            Email
                        </label>
                        <input type="email" id="email" name="email" placeholder="info@example.com"
                            value="{{ old('email', $companyProfile->email ?? '') }}"
                            class="w-full rounded-lg border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-neutral-100 px-4 py-3 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition-colors" />
                    </div>
                </div>

                {{-- Instagram --}}
                <div>
                    <label for="instagram" class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300 mb-2">
                        Instagram
                    </label>
                    <input type="text" id="instagram" name="instagram" placeholder="@ghinatourandtravel"
                        value="{{ old('instagram', $companyProfile->instagram ?? '') }}"
                        class="w-full rounded-lg border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-neutral-100 px-4 py-3 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition-colors" />
                </div>
            </div>

            {{-- Submit --}}
            <div class="px-6 py-4 border-t border-neutral-100 dark:border-neutral-800 flex justify-end">
                <button type="submit"
                    class="inline-flex items-center gap-2 px-6 py-2.5 rounded-lg text-sm font-semibold bg-amber-500 text-black hover:bg-amber-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection
