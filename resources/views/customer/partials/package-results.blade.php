@if (($query ?? '') !== '')
    <p class="tm mb-6">Menampilkan paket untuk "{{ $query }}".</p>
@endif

@if ($pakets->count() > 0)
    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @foreach ($pakets as $paket)
            @include('components.customer.package-card', ['paket' => $paket])
        @endforeach
    </div>

    @include('components.ui.pagination', ['paginator' => $pakets])
@else
    <div class="rounded-3xl border border-[var(--border)] bg-[var(--bg-card)] px-6 py-16 text-center">
        <h2 class="text-2xl font-extrabold t">Tidak Ada Paket Ditemukan</h2>
        <p class="tm mt-2">Coba gunakan kata kunci lain atau hapus pencarian untuk melihat semua paket.</p>
    </div>
@endif
