# Sentra Sehat - Aplikasi Digitalisasi Kesehatan Masyarakat

Selamat datang di Sentra Sehat, aplikasi berbasis Laravel yang dirancang untuk memudahkan pengelolaan data kesehatan masyarakat secara digital. Aplikasi ini menyediakan dashboard interaktif dengan visualisasi data, peta distribusi penyakit, dan fitur manajemen data penduduk, intervensi kesehatan, obat, dan lainnya.

## Fitur Utama

- Dashboard utama dengan ringkasan data kesehatan masyarakat.
- Visualisasi peta distribusi penyakit berdasarkan wilayah menggunakan Google Maps API.
- Grafik intervensi kesehatan per wilayah menggunakan Chart.js.
- Manajemen data penduduk, intervensi, penyakit, obat, dan kesehatan lingkungan.
- Role-based access control untuk super admin, puskesmas admin, dokter, dan kepala desa.
- Tampilan responsif dan modern dengan animasi dan efek visual menarik.

## Instalasi

1. Clone repository ini:
   ```
   git clone <repository-url>
   cd digitalisasi-sentra-sehat
   ```

2. Install dependencies PHP dan JavaScript:
   ```
   composer install
   npm install
   ```

3. Salin file environment dan konfigurasi:
   ```
   cp .env.example .env
   php artisan key:generate
   ```

4. Konfigurasi Google Maps API Key:
   - Dapatkan API key dari [Google Cloud Console](https://console.cloud.google.com/)
   - Aktifkan Google Maps JavaScript API
   - Tambahkan API key ke file `.env`:
     ```
     GOOGLE_MAPS_KEY=your_api_key_here
     ```

5. Sesuaikan konfigurasi database di file `.env`.

6. **Jalankan migrasi database** (PENTING):

   **Pilih salah satu opsi berikut:**

   **Opsi A: Migrasi saja (untuk production/development kosong)**
   ```
   php artisan migrate
   ```
   *Hanya membuat struktur tabel database tanpa data awal*

   **Opsi B: Migrasi dengan seeder (untuk testing/development penuh)**
   ```
   php artisan migrate --seed
   ```
   *Membuat struktur tabel database dan mengisi data awal untuk testing*

   **Penjelasan Migrasi Database:**
   Migrasi ini akan membuat struktur database lengkap untuk aplikasi Sentra Sehat dengan tabel-tabel berikut:

   - **users**: Tabel pengguna dengan role-based access (super_admin, puskesmas_admin, dokter, kades, patient)
   - **roles & sektors**: Tabel untuk sistem otorisasi dan pembagian wilayah kerja
   - **penduduk**: Data penduduk dengan NIK, informasi personal, dan data kesehatan
   - **wilayahs**: Data wilayah desa dengan koordinat latitude/longitude untuk peta
   - **tindakan_intervensis**: Catatan intervensi kesehatan yang dilakukan
   - **obats**: Data obat-obatan yang tersedia
   - **penyakits**: Data penyakit dengan kode ICD dan spesialisasi
   - **kesehatan_lingkungan**: Data kesehatan lingkungan per wilayah
   - **kesehatan_gizi**: Data kesehatan gizi masyarakat
   - **kesehatan_anak_ibu**: Data kesehatan anak dan ibu hamil
   - **faktor_risikos**: Data faktor risiko kesehatan
   - **rencana_lanjutans**: Rencana tindak lanjut intervensi kesehatan

   **Seeder akan mengisi data awal (hanya untuk opsi B):**
   - Role dan sektor pengguna
   - Data wilayah desa dengan koordinat peta

   - Akun admin default untuk setiap role
7. Jalankan aplikasi:
   ```
   php artisan serve
   npm run dev
   ```

8. Akses aplikasi di `http://localhost:8000`.

   **Akun Login Default:**
   - **Super Admin**: email: superadmin@sentrasehat.com, password: password
   - **Puskesmas Admin**: email: puskesmas@sentrasehat.com, password: password
   - **Dokter**: email: dokter@sentrasehat.com, password: password
   - **Kades**: email: kades@sentrasehat.com, password: password
   - **Patient**: email: patient@sentrasehat.com, password: password

## Penggunaan

- Login menggunakan akun yang sudah didaftarkan.
- Dashboard menampilkan ringkasan data sesuai role pengguna.
- Gunakan menu navigasi untuk mengelola data penduduk, intervensi, obat, dan lainnya.
- Pada dashboard, gunakan tombol toggle untuk berpindah antara peta dan grafik distribusi penyakit.
- Klik marker pada peta untuk melihat detail intervensi di wilayah tersebut.
- Gunakan fitur filter dan export pada tabel statistik wilayah.

## Pengembangan

- Frontend menggunakan Blade templating dengan Tailwind CSS.
- Peta menggunakan Google Maps API.
- Grafik menggunakan Chart.js.
- Backend menggunakan Laravel 8 dengan Eloquent ORM.
- Role dan permission diatur menggunakan middleware Laravel.

## Testing

- Pastikan untuk melakukan testing pada halaman dashboard utama, terutama interaksi peta dan grafik.
- Uji coba input data baru dan pengelolaan data melalui menu terkait.
- Verifikasi tampilan responsif pada berbagai perangkat.

## Kontribusi

Kontribusi sangat diterima! Silakan buat pull request atau laporkan isu di repository ini.

## Lisensi

Aplikasi ini menggunakan lisensi MIT.

---

Terima kasih telah menggunakan Sentra Sehat untuk digitalisasi data kesehatan masyarakat Anda!
