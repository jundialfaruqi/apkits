<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kegiatan;
use App\Models\Rancangan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RancanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $kegiatans = Kegiatan::all();

        foreach ($users as $user) {
            foreach ($kegiatans as $kegiatan) {
                Rancangan::create([
                    'user_id' => $user->id,
                    'kegiatan_id' => $kegiatan->id,
                    'jenis_kegiatan' => 'Contoh Jenis Kegiatan',
                    'tanggal' => now(),
                    'tempat' => 'Contoh Tempat',
                    'pelaksanaan_kerja' => 'Contoh pelaksanaan kerja',
                    'progress' => rand(0, 100),
                    'foto' => null,
                ]);
            }
        }
    }
}
