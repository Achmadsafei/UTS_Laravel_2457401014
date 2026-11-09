<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Room::query()->delete();

        foreach ([
            ['room_number' => 'A01', 'room_type' => 'Standar', 'floor' => 1, 'monthly_price' => 650000, 'capacity' => 1, 'is_available' => true, 'facilities' => 'Kasur, lemari, kipas angin, Wi-Fi', 'description' => 'Kamar nyaman dekat area parkir.'],
            ['room_number' => 'A02', 'room_type' => 'Deluxe', 'floor' => 1, 'monthly_price' => 950000, 'capacity' => 1, 'is_available' => false, 'facilities' => 'Kasur, lemari, AC, kamar mandi dalam, Wi-Fi', 'description' => 'Kamar mandi dalam dan pencahayaan alami.'],
            ['room_number' => 'A03', 'room_type' => 'Standar', 'floor' => 1, 'monthly_price' => 600000, 'capacity' => 1, 'is_available' => true, 'facilities' => 'Kasur, meja belajar, lemari, Wi-Fi', 'description' => 'Kamar tenang untuk belajar.'],
            ['room_number' => 'A04', 'room_type' => 'Premium', 'floor' => 1, 'monthly_price' => 1250000, 'capacity' => 2, 'is_available' => true, 'facilities' => 'Kasur queen, AC, kamar mandi dalam, meja, Wi-Fi', 'description' => 'Kamar luas untuk satu atau dua penghuni.'],
            ['room_number' => 'B01', 'room_type' => 'Deluxe', 'floor' => 2, 'monthly_price' => 900000, 'capacity' => 1, 'is_available' => true, 'facilities' => 'Kasur, lemari, AC, kamar mandi dalam, Wi-Fi', 'description' => 'Menghadap halaman kos yang rindang.'],
            ['room_number' => 'B02', 'room_type' => 'Standar', 'floor' => 2, 'monthly_price' => 575000, 'capacity' => 1, 'is_available' => false, 'facilities' => 'Kasur, lemari, kipas angin, Wi-Fi', 'description' => 'Kamar sederhana dengan suasana tenang.'],
            ['room_number' => 'B03', 'room_type' => 'Premium', 'floor' => 2, 'monthly_price' => 1300000, 'capacity' => 2, 'is_available' => true, 'facilities' => 'Kasur queen, AC, kamar mandi dalam, kulkas, Wi-Fi', 'description' => 'Kamar premium dengan ruang penyimpanan tambahan.'],
            ['room_number' => 'B04', 'room_type' => 'Deluxe', 'floor' => 2, 'monthly_price' => 875000, 'capacity' => 1, 'is_available' => true, 'facilities' => 'Kasur, meja kerja, AC, kamar mandi dalam, Wi-Fi', 'description' => 'Cocok untuk penghuni yang bekerja dari kamar.'],
            ['room_number' => 'C01', 'room_type' => 'Standar', 'floor' => 3, 'monthly_price' => 550000, 'capacity' => 1, 'is_available' => true, 'facilities' => 'Kasur, lemari, kipas angin, Wi-Fi', 'description' => 'Pilihan hemat di lantai paling atas.'],
            ['room_number' => 'C02', 'room_type' => 'Deluxe', 'floor' => 3, 'monthly_price' => 925000, 'capacity' => 1, 'is_available' => false, 'facilities' => 'Kasur, lemari, AC, kamar mandi dalam, Wi-Fi', 'description' => 'Kamar sejuk dengan kamar mandi pribadi.'],
            ['room_number' => 'C03', 'room_type' => 'Standar', 'floor' => 3, 'monthly_price' => 625000, 'capacity' => 1, 'is_available' => true, 'facilities' => 'Kasur, meja belajar, lemari, Wi-Fi', 'description' => 'Kamar terang dengan meja belajar.'],
            ['room_number' => 'C04', 'room_type' => 'Premium', 'floor' => 3, 'monthly_price' => 1400000, 'capacity' => 2, 'is_available' => true, 'facilities' => 'Kasur queen, AC, kamar mandi dalam, kulkas, Wi-Fi', 'description' => 'Kamar paling luas dengan fasilitas lengkap.'],
            ['room_number' => 'D01', 'room_type' => 'Standar', 'floor' => 4, 'monthly_price' => 525000, 'capacity' => 1, 'is_available' => true, 'facilities' => 'Kasur, lemari, kipas angin, Wi-Fi', 'description' => 'Kamar nyaman dengan harga terjangkau.'],
            ['room_number' => 'D02', 'room_type' => 'Deluxe', 'floor' => 4, 'monthly_price' => 975000, 'capacity' => 1, 'is_available' => false, 'facilities' => 'Kasur, lemari, AC, kamar mandi dalam, Wi-Fi', 'description' => 'Kamar privat yang siap dihuni.'],
        ] as $room) {
            Room::create($room);
        }
    }
}
