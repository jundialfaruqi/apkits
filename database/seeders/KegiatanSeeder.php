<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kegiatan::create([
            'nama_kegiatan' => 'Rancangan Kegiatan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Kegiatan::create([
            'nama_kegiatan' => 'IT Request',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Kegiatan::create([
            'nama_kegiatan' => 'Pengolahan Data',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
