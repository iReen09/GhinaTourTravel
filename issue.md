# Perbaikan Minor UI Dashboard, Kalkulasi Harga Pesanan, dan Ukuran Logo Login

## Deskripsi
Issue ini dibuat untuk merencanakan beberapa perbaikan minor pada antarmuka admin dan perbaikan logika tampilan harga pada tabel pesanan agar konsisten dengan invoice.

## Rencana Pengerjaan (Planning)

### 1. Penyesuaian Kolom Tabel di Dashboard Admin
- **File Target**: `resources/views/admin/index.blade.php`
- **Tindakan**:
  - Mengubah heading tabel `<th>Jumlah Orang</th>` menjadi `<th>Pax</th>`.
  - Mengubah format data pada baris tabel dari `{{ $p->jumlah_orang }} orang` menjadi `{{ $p->jumlah_orang }} pax` agar selaras dengan tampilan di menu Pesanan.

### 2. Perbaikan Perhitungan Harga Coret pada Tabel Pesanan
- **File Target**: `resources/views/admin/pesanan/index.blade.php`
- **Masalah**: Harga sebelum diskon (harga coret) saat ini dihitung terbalik dari `total_harga` setelah diskon. Hal ini bisa menyebabkan ketidakakuratan karena pembulatan.
- **Tindakan**:
  - Mengubah perhitungan `originalPrice` menggunakan rumus `$p->paket->harga_paket * $p->jumlah_orang`.
  - Ini akan memastikan angka yang tampil persis sama dengan nilai **Subtotal** yang tertera pada Invoice.

### 3. Penyesuaian Ukuran Logo pada Form Login
- **File Target**: `resources/views/login.blade.php`
- **Masalah**: Logo perusahaan yang baru ditambahkan ke dalam form login admin saat ini masih terlihat terlalu besar (`w-12 h-12` di dalam wrapper 64px).
- **Tindakan**:
  - Mengecilkan ukuran logo menjadi `w-8 h-8` (32px) atau menyesuaikan padding `.icon-wrap` agar proporsi logo terlihat lebih elegan dan profesional.

---

### Pertanyaan Validasi
Sebelum implementasi dilakukan, mohon validasi untuk poin berikut:
> **Terkait ukuran logo di form login (poin 3):** Apakah Anda lebih suka mengecilkan gambar logonya (misal jadi `w-8 h-8`), atau mengecilkan lingkaran luar (`.icon-wrap`)-nya sekalian agar card login tidak terlalu memakan ruang vertikal?
