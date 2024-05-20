<?php

namespace Database\Seeders;

use App\Models\BiayaDaftarUlang;
use Illuminate\Database\Seeder;

class BiayaDaftarUlangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kaos_olahraga = 150000;
        $bed_lokasi_dll = 75000;
        $baju_seragam = 230000;

        BiayaDaftarUlang::create([
            'kelas_id' => 1,
            'pilihan_pembayaran' => 'Lunas',
            'uang_pangkal' => 3200000,
            'uang_spp' => 410000,
            'kaos_olahraga' => $kaos_olahraga,
            'bed_lokasi_dll' => $bed_lokasi_dll,
            'baju_seragam' => $baju_seragam,
        ]);
        BiayaDaftarUlang::create([
            'kelas_id' => 2,
            'pilihan_pembayaran' => 'Lunas',
            'uang_pangkal' =>  2500000,
            'uang_spp' => 330000,
            'kaos_olahraga' => $kaos_olahraga,
            'bed_lokasi_dll' => $bed_lokasi_dll,
            'baju_seragam' => $baju_seragam,
        ]);
        BiayaDaftarUlang::create([
            'kelas_id' => 2,
            'pilihan_pembayaran' => 'Angsuran',
            'uang_pangkal' =>  1500000,
            'uang_spp' => 330000,
            'kaos_olahraga' => $kaos_olahraga,
            'bed_lokasi_dll' => $bed_lokasi_dll,
            'baju_seragam' => $baju_seragam,
        ]);
        BiayaDaftarUlang::create([
            'kelas_id' => 3,
            'pilihan_pembayaran' => 'Lunas',
            'uang_pangkal' => 2400000,
            'uang_spp' => 280000,
            'kaos_olahraga' => $kaos_olahraga,
            'bed_lokasi_dll' => $bed_lokasi_dll,
            'baju_seragam' => $baju_seragam,
        ]);
        BiayaDaftarUlang::create([
            'kelas_id' => 3,
            'pilihan_pembayaran' => 'Angsuran',
            'uang_pangkal' => 1400000,
            'uang_spp' => 280000,
            'kaos_olahraga' => $kaos_olahraga,
            'bed_lokasi_dll' => $bed_lokasi_dll,
            'baju_seragam' => $baju_seragam,
        ]);
    }
}
