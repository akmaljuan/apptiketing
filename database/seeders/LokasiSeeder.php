<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lokasi;

class LokasiSeeder extends Seeder
{
    public function run(): void
    {
        Lokasi::insert([
            ['nama_lokasi' => 'Stadion Utama', 'created_at' => now(), 'updated_at' => now()],
            ['nama_lokasi' => 'Galeri Seni Kota', 'created_at' => now(), 'updated_at' => now()],
            ['nama_lokasi' => 'Taman Kota', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
