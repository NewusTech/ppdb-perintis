<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kelas::create([
            'jenis_kelas' => 'Executive',
            'biaya_pendaftaran' => 120000,
        ]);
        Kelas::create([
            'jenis_kelas' => 'Regular AC',
            'biaya_pendaftaran' => 100000,
        ]);
        Kelas::create([
            'jenis_kelas' => 'Regular Non AC',
            'biaya_pendaftaran' => 100000,
        ]);
    }
}
