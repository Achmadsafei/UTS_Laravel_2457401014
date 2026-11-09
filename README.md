# Kos Achmad Safei

Aplikasi Laravel untuk mengelola daftar kamar Kos Achmad Safei. CRUD mencakup nomor kamar, tipe, lantai, harga bulanan, kapasitas, status, fasilitas, dan deskripsi.

## Identitas dan tema

- Nama: Achmad Safei.
- NIM: 2457401014.
- Tema: Kos; data tersimpan di tabel `rooms`.
- Seeder: 14 data kamar (10 + digit terakhir NIM, yaitu 4).

## Persiapan

1. Salin `.env.example` menjadi `.env`, lalu sesuaikan kredensial database.
2. Pasang dependency dan buat application key:

   ```sh
   composer install
   php artisan key:generate
   ```

3. Jalankan migration dan seeder:

   ```sh
   php artisan migrate --seed
   ```

4. Jalankan aplikasi:

   ```sh
   php artisan serve
   ```

Buka `http://127.0.0.1:8000`. Untuk membuat ulang data contoh, gunakan `php artisan migrate:fresh --seed`; perintah tersebut menghapus semua tabel aplikasi.

## Kolom tabel `rooms`

| Kolom | Keterangan |
|---|---|
| `room_number` | Nomor kamar, unik |
| `room_type` | Tipe Standar, Deluxe, atau Premium |
| `floor` | Nomor lantai |
| `monthly_price` | Harga sewa per bulan dalam rupiah |
| `capacity` | Kapasitas penghuni |
| `is_available` | Status tersedia atau terisi |
| `facilities` | Daftar fasilitas kamar |
| `description` | Deskripsi tambahan, opsional |
| `id`, `created_at`, `updated_at` | ID dan waktu pencatatan |

## Halaman untuk dokumentasi screenshot

1. **Halaman Beranda** — `/`
2. **Halaman Daftar Data** — `/rooms`
3. **Form Tambah Data Kosong** — `/rooms/create`
4. **Form Tambah Data dengan Pesan Error Validasi** — kirim form kosong di `/rooms/create`
5. **Halaman Daftar Data dengan Pesan Sukses Setelah Menambah Data** — simpan data valid dan kembali ke `/rooms`
6. **Halaman Detail Data** — pilih **Detail** di daftar kamar
7. **Form Ubah Data dengan Data Lama** — pilih **Ubah** di daftar kamar
8. **Konfirmasi Sebelum Menghapus Data** — pilih **Hapus** di daftar kamar
9. **Halaman Daftar Data dengan Pesan Sukses Setelah Menghapus Data** — konfirmasi hapus dan kembali ke `/rooms`

## Pengujian

```sh
php artisan test
```
