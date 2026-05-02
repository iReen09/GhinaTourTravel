# Plan: Integrasi Chatbot Frontend & Filter Dashboard Admin

## 1. Integrasi Frontend Chatbot
**Tujuan:** Membuat antarmuka (UI) chatbot interaktif bagi pelanggan yang terintegrasi langsung dengan backend AI Agent (`ChatbotController`) menggunakan palet warna (gold/dark/light theme) dari proyek Ghina Tour Travel.

**Langkah High-Level:**
*   **UI/UX Chat Widget:** 
    *   Buat komponen floating chat widget (tombol chat di pojok kanan bawah yang membuka jendela obrolan).
    *   Sesuaikan desain dengan tema utama (menggunakan variabel warna `--gold`, `--bg-card`, dll yang sudah ada).
*   **Integrasi Backend (API Calls):**
    *   Gunakan JavaScript (Fetch/Axios) untuk mengambil pesan awal dan opsi menu dari endpoint `getMenu()`.
    *   Kirim pesan input dari user ke endpoint `handleMessage()`.
    *   Implementasikan *quick actions* (tombol menu cepat) untuk memicu fungsi spesifik seperti `getPakets()`, `getCompanyProfile()`, dan `searchPesanan()`.
*   **State Management:**
    *   Kelola riwayat obrolan (chat history) sementara di sisi klien agar percakapan terasa natural.
    *   Tampilkan indikator *loading/typing* saat menunggu balasan dari AI Agent.

---

## 2. Fitur Filter & Pencarian Pesanan di Admin Dashboard
**Tujuan:** Memudahkan admin dalam mengelola dan mencari data pesanan dengan menambahkan fitur pencarian teks dan filter spesifik pada halaman indeks pesanan.

**Langkah High-Level:**
*   **Pembaruan UI Admin (`pesanan/index.blade.php`):**
    *   Tambahkan *Search Bar* (untuk mencari nama pemesan, no HP, atau invoice).
    *   Tambahkan *Dropdown Filter* untuk **Status Pesanan** (misal: pending, lunas, dp).
    *   Tambahkan *Input Date/Date Range* untuk filter berdasarkan **Tanggal Acara**.
*   **Pembaruan Backend (`PesananController@index`):**
    *   Tangkap parameter `request` (search, status, tanggal).
    *   Modifikasi *Eloquent Query* pada model `Pesanan` secara dinamis menggunakan klausa `where` atau `when` berdasarkan parameter yang dikirim dari UI.
    *   Pastikan pagination tetap berjalan lancar bersamaan dengan parameter filter (append query string).
