# Perpustakaan Achmad safei

Aplikasi katalog perpustakaan dengan Laravel untuk mengelola buku melalui fitur tambah, daftar, detail, ubah, dan hapus.

## Identitas dan tema

- Nama mahasiswa: Achmad safei (`APP_STUDENT_NAME` di `.env`).
- NIM: 24574010140.
- Tema: Perpustakaan — tabel `books`.
- Database: `uts_24574010140`.
- Seeder: 10 data buku (`10 + digit terakhir NIM`).

## Persiapan

1. Buat database MySQL/MariaDB bernama `uts_24574010140`.
2. Salin `.env.example` menjadi `.env`, lalu sesuaikan `APP_STUDENT_NAME` dan kredensial database.
3. Pasang dependency dan buat application key:

   ```sh
   composer install
   php artisan key:generate
   ```

4. Jalankan migration dan seeder:

   ```sh
   php artisan migrate --seed
   ```

5. Jalankan aplikasi:

   ```sh
   php artisan serve
   ```

Buka `http://127.0.0.1:8000`. Untuk mengulang data contoh, gunakan `php artisan migrate:fresh --seed`; perintah tersebut menghapus semua data aplikasi.

## Kolom tabel

| Kolom | Tipe | Keterangan |
|---|---|---|
| `title` | string | Judul buku |
| `author` | string | Penulis |
| `category` | string | Novel, Teknologi, atau Sejarah |
| `published_at` | date | Tanggal terbit |
| `stock` | integer | Jumlah stok |
| `is_available` | boolean | Status ketersediaan |
| `synopsis` | text, nullable | Sinopsis buku |
| `isbn` | string, nullable | Kolom tambahan; hanya boleh berisi angka |
| `id`, `created_at`, `updated_at` | otomatis | ID dan waktu pencatatan |

## Halaman untuk dokumentasi screenshot

1. Halaman Beranda — `/`
2. Halaman daftar data — `/books`
3. Form tambah data kosong — `/books/create`
4. Form tambah dengan pesan error — kirim form kosong di `/books/create`
5. Halaman daftar dengan pesan sukses — otomatis kembali ke `/books` setelah menyimpan buku
6. Halaman detail data — pilih tombol **Detail** di daftar
7. Form ubah terisi data lama — pilih tombol **Ubah** di daftar
8. Konfirmasi sebelum menghapus — pilih tombol **Hapus** di daftar
9. Halaman daftar dengan pesan sukses setelah menghapus — konfirmasi hapus dan kembali ke `/books`

Setiap halaman memakai layout dan footer bersama. Ganti `APP_STUDENT_NAME` dan `APP_STUDENT_NIM` di `.env` sebelum mengambil screenshot.

## Pengujian

```sh
php artisan test
```
