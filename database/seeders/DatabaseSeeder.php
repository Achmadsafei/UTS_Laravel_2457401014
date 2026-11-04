<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Book::query()->delete();

        foreach ([
            [
                'title' => 'Belajar PHP dari Nol',
                'author' => 'Rina Kusuma',
                'category' => 'Teknologi',
                'published_at' => '2024-03-15',
                'stock' => 5,
                'is_available' => true,
                'synopsis' => 'Panduan dasar PHP untuk pemula.',
                'isbn' => '9786021234567',
            ],
            [
                'title' => 'Senja di Kota Hujan',
                'author' => 'Dimas Pratama',
                'category' => 'Novel',
                'published_at' => '2022-08-01',
                'stock' => 0,
                'is_available' => false,
                'synopsis' => null,
                'isbn' => '9786021234568',
            ],
            [
                'title' => 'Jejak Kerajaan Nusantara',
                'author' => 'Sari Wulandari',
                'category' => 'Sejarah',
                'published_at' => '2019-11-20',
                'stock' => 3,
                'is_available' => true,
                'synopsis' => 'Ringkasan sejarah kerajaan di Nusantara.',
                'isbn' => '9786021234569',
            ],
            [
                'title' => 'Laravel untuk Aplikasi Modern',
                'author' => 'Aditya Firmansyah',
                'category' => 'Teknologi',
                'published_at' => '2023-06-10',
                'stock' => 8,
                'is_available' => true,
                'synopsis' => 'Membangun aplikasi web dengan Laravel.',
                'isbn' => '9786021234570',
            ],
            [
                'title' => 'Langit di Ujung Jalan',
                'author' => 'Maya Anindita',
                'category' => 'Novel',
                'published_at' => '2021-02-14',
                'stock' => 2,
                'is_available' => true,
                'synopsis' => null,
                'isbn' => '9786021234571',
            ],
            [
                'title' => 'Sejarah Indonesia Ringkas',
                'author' => 'Bambang Santoso',
                'category' => 'Sejarah',
                'published_at' => '2018-08-17',
                'stock' => 4,
                'is_available' => true,
                'synopsis' => 'Perjalanan sejarah Indonesia dari masa ke masa.',
                'isbn' => '9786021234572',
            ],
            [
                'title' => 'Dasar-Dasar Jaringan Komputer',
                'author' => 'Nadia Putri',
                'category' => 'Teknologi',
                'published_at' => '2020-05-22',
                'stock' => 1,
                'is_available' => true,
                'synopsis' => 'Pengenalan konsep dan praktik jaringan komputer.',
                'isbn' => '9786021234573',
            ],
            [
                'title' => 'Pulang Sebelum Senja',
                'author' => 'Fajar Ramadhan',
                'category' => 'Novel',
                'published_at' => '2024-01-08',
                'stock' => 0,
                'is_available' => false,
                'synopsis' => 'Kisah keluarga dan perjalanan menemukan rumah.',
                'isbn' => '9786021234574',
            ],
            [
                'title' => 'Arsitektur Komputer',
                'author' => 'Dewi Lestari',
                'category' => 'Teknologi',
                'published_at' => '2017-09-12',
                'stock' => 6,
                'is_available' => true,
                'synopsis' => 'Mengenal komponen dan cara kerja komputer.',
                'isbn' => '9786021234575',
            ],
            [
                'title' => 'Kisah Para Pahlawan',
                'author' => 'Rudi Hartono',
                'category' => 'Sejarah',
                'published_at' => '2016-11-10',
                'stock' => 3,
                'is_available' => true,
                'synopsis' => 'Kisah tokoh-tokoh penting dalam sejarah bangsa.',
                'isbn' => '9786021234576',
            ],
        ] as $book) {
            Book::create($book);
        }
    }
}
