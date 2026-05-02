# Product Requirements Document (PRD)
## Sistem Manajemen Ghina Tour Travel

---

## 1. Gambaran Umum (Overview)
**Sistem Manajemen Ghina Tour Travel** adalah aplikasi berbasis web yang dirancang untuk merampingkan operasional agen perjalanan. Sistem ini menyediakan portal khusus pelanggan di mana pengguna dapat menjelajahi paket wisata, melihat *itinerary* (jadwal perjalanan), dan berinteraksi dengan asisten virtual (Chatbot) untuk mendapatkan informasi secara cepat. Untuk sisi bisnis, sistem ini menawarkan *Admin Dashboard* yang aman untuk mengelola paket wisata, melacak pesanan pelanggan, memperbarui profil perusahaan, dan mengelola galeri visual.

## 2. Persyaratan Sistem (Requirements)
*   **Aksesibilitas Web:** Sistem harus dapat diakses melalui browser web modern dan responsif pada perangkat desktop maupun seluler (mobile).
*   **Performa:** Waktu pemuatan (loading) yang cepat untuk halaman pelanggan guna memastikan kenyamanan dan retensi pengguna yang tinggi.
*   **Keamanan:** Dashboard Admin harus dilindungi oleh sistem otentikasi (login). Data pelanggan yang sensitif (seperti nomor telepon, invoice pesanan) harus ditangani secara aman.
*   **Otomatisasi:** Sistem harus mengotomatiskan penyaringan (filtering) pesanan dan memberikan respons instan berbasis aturan (*rule-based*) melalui Chatbot tanpa memerlukan API AI pihak ketiga.
*   **Skalabilitas:** Arsitektur database harus mampu menangani data relasional secara efisien (seperti Paket, Fasilitas, Tempat Tujuan, Galeri, dan Pesanan).

## 3. Fitur Utama (Core Features)

### 3.1. Portal Pelanggan
*   **Eksplorasi Paket:** Pelanggan dapat melihat paket tour yang tersedia, termasuk harga, durasi, jadwal kegiatan (*rundown*), dan fasilitas yang termasuk di dalamnya.
*   **Informasi Perusahaan:** Akses ke sejarah perusahaan, visi, misi, dan detail kontak.
*   **Asisten Virtual (Chatbot):** *Widget floating* (mengambang) yang memungkinkan pelanggan mencari detail paket, memeriksa status pesanan (menggunakan nomor telepon atau ID invoice), dan melihat info perusahaan melalui menu panduan atau input kata kunci (*keyword*).

### 3.2. Admin Dashboard
*   **Manajemen Pesanan (Order Management):** 
    *   Melihat, mengedit, dan menghapus pesanan pelanggan.
    *   Penyaringan tingkat lanjut dengan fungsi otomatis submit (*auto-submit*) (Pencarian berdasarkan nama/invoice, Filter berdasarkan Status, Filter berdasarkan Tanggal).
*   **Manajemen Paket (Package Management):** 
    *   Membuat dan mengelola paket tour (`Paket`).
    *   Mengelola tempat tujuan (`Tempat`) dan fasilitas (`Fasilitas`) yang terhubung dengan masing-masing paket.
*   **Manajemen Galeri:** Mengunggah dan mengelola gambar promosi yang ditautkan ke fasilitas atau tempat tujuan tertentu.
*   **Manajemen Profil Perusahaan:** Memperbarui informasi bisnis, tautan media sosial, dan detail kontak yang ditampilkan kepada pelanggan.

---

## 4. Alur Pengguna (User Flow)

### 4.1. Alur Pelanggan (Customer Flow)
1.  **Halaman Utama (Landing):** Pelanggan mengunjungi beranda website.
2.  **Eksplorasi:** Menjelajahi paket tour yang tersedia dan melihat detailnya (harga, *rundown*, fasilitas).
3.  **Bantuan Cepat:** Mengklik widget Chatbot untuk bantuan instan. Mengetik "menu" atau kata kunci spesifik (misal: "info paket"). Chatbot akan mengambil data *real-time* dari database dan memberikan balasan.
4.  **Pelacakan Pesanan:** Pelanggan mengetikkan nomor telepon mereka ke dalam Chatbot untuk mengecek status pesanan yang telah mereka buat.

### 4.2. Alur Admin (Admin Flow)
1.  **Otentikasi:** Admin masuk (login) ke dashboard yang aman.
2.  **Pemrosesan Pesanan:** Navigasi ke halaman "Pesanan". Menggunakan *Search Bar* atau *Dropdown Status* (yang melakukan submit otomatis) untuk menemukan pesanan yang berstatus *pending* (menunggu) dengan cepat.
3.  **Pembaruan Konten:** Navigasi ke halaman "Paket" atau "Company Profile" untuk memperbarui harga, menambah tujuan tour baru, atau memperbarui info kontak.
4.  **Kueri Cepat:** Admin juga dapat menggunakan widget Chatbot yang terintegrasi di dashboard untuk mengambil invoice pesanan atau detail paket tertentu secara cepat tanpa harus berpindah-pindah menu.

---

## 5. Skema Database (Database Schema)

Database menggunakan struktur relasional untuk menghubungkan paket dengan atributnya dan dengan pesanan pelanggan.

### 5.1. `users` (Pengguna/Admin)
*   **id** (Primary Key)
*   **name**, **email**, **password**
*   *Kolom otentikasi standar Laravel.*

### 5.2. `pakets` (Paket Tour)
*   **id** (Primary Key)
*   **nama_paket** (String)
*   **harga_paket** (Decimal)
*   **durasi** (String)
*   **rundown** (Text)
*   **note** (Text, nullable)

### 5.3. `tempats` (Tempat Tujuan)
*   **id** (Primary Key)
*   **nama_tempat** (String)
*   **id_paket** (Foreign Key -> pakets.id)

### 5.4. `fasilitas` (Fasilitas)
*   **id** (Primary Key)
*   **nama_fasilitas** (String)
*   **tipe_fasilitas** (String)
*   **id_paket** (Foreign Key -> pakets.id)

### 5.5. `galleries` (Galeri Gambar)
*   **id** (Primary Key)
*   **path** (String - URL/Path Gambar)
*   **keterangan** (String, nullable)
*   **id_fasilitas** (Foreign Key -> fasilitas.id, nullable)
*   **id_tempat** (Foreign Key -> tempats.id, nullable)

### 5.6. `pesanans` (Pesanan)
*   **id** (Primary Key)
*   **nama_pemesan** (String)
*   **no_hp** (String)
*   **tanggal_acara** (Date)
*   **jumlah_orang** (Integer)
*   **total_harga** (Decimal)
*   **diskon** (Decimal)
*   **invoice** (String, unique)
*   **status** (String - cth: pending, selesai, batal)
*   **id_paket** (Foreign Key -> pakets.id)

### 5.7. `company_profiles` (Profil Perusahaan)
*   **id** (Primary Key)
*   **about** (Text)
*   **vision_mission** (Text, nullable)
*   **address** (Text)
*   **email**, **whatsapp**, **instagram** (Strings)
