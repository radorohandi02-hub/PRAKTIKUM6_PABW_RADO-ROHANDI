# LaporBanjir – BPBD Kabupaten Bandung

Aplikasi Laravel 12 (+ Breeze) untuk menerima laporan banjir dari warga beserta foto bukti,
dan mengelolanya oleh petugas (lihat, ubah status, ganti foto, hapus).

## Cara menjalankan (XAMPP / Laragon)
1. Nyalakan Apache + MySQL, buka phpMyAdmin, buat database **db_laporbanjir**.
2. Di folder project:
   ```bash
   composer install
   npm install && npm run build      # folder public/build sudah disertakan, langkah ini opsional
   php artisan migrate:fresh --seed  # buat tabel + akun petugas
   php artisan storage:link          # wajib agar foto bisa tampil
   php artisan serve
   ```
   `.env` sudah memakai `DB_DATABASE=db_laporbanjir`, user `root`, password kosong.
   Jika `.env` hilang: `cp .env.example .env && php artisan key:generate`.
3. Buka `http://127.0.0.1:8000` (form warga) dan `/login` (petugas).

Akun petugas (PetugasSeeder): `admin@bpbd.test` / `admin12345` — ganti password ini sebelum dipakai sungguhan.
Data contoh (12 laporan tanpa foto, untuk mencoba pagination): `php artisan db:seed --class=LaporanSeeder`.
Menjalankan test: `php artisan test`.

## Peta ketentuan soal → kode
| Ketentuan | Lokasi |
|---|---|
| a. Project & .env | `.env` (`DB_DATABASE=db_laporbanjir`) |
| b. Model + migration | `app/Models/Laporan.php`, `database/migrations/*_create_laporan_table.php` |
| c. Form + upload + validasi | `resources/views/lapor/create.blade.php`, `app/Http/Requests/LaporanRequest.php`, `LaporController@store` (`->store('laporan','public')`) |
| d. CRUD petugas | `Route::resource('laporan', ...)` di `routes/web.php` dalam `middleware('auth')`, `LaporanController` |
| e. Pengelolaan file | `LaporanController@update` & `@destroy` (`Storage::disk('public')->delete(...)`) |
| f. Pesan & validasi | flash `success` di `layouts/app.blade.php`, `<x-input-error>` di bawah tiap input |
| g. Breeze vs manual | bagian di bawah |

## g. Alasan memilih Laravel Breeze
Autentikasi petugas adalah bagian yang paling rawan salah jika ditulis manual (hash password,
perlindungan CSRF, regenerasi session saat login untuk mencegah session fixation, pembatasan
percobaan login/throttling, logout yang menginvalidasi session). Breeze menyediakannya dalam bentuk
kode Laravel biasa yang sudah teruji dan mudah dibaca (controller + Blade, bukan paket tertutup),
sehingga waktu pengerjaan bisa difokuskan pada inti soal: upload file dan CRUD. Breeze juga
menyediakan middleware `auth`/`guest` yang langsung dipakai untuk melindungi halaman pengelolaan.
Dari scaffolding Breeze hanya login & logout yang dipakai; registrasi publik sengaja dihapus
karena akun petugas BPBD harus dibuat oleh admin (seeder), bukan oleh sembarang orang yang
dapat menghapus laporan.

## Catatan keamanan upload
- Validasi `image|mimes:jpg,jpeg,png|max:2048` (2048 KB = 2 MB) — dicek di server, bukan hanya `accept` di HTML.
- Nama file dibuat acak oleh `store()` sehingga nama asli dari pengguna tidak dipakai di server.
- Foto lama dihapus setelah data baru berhasil tersimpan; foto ikut terhapus saat laporan dihapus.
