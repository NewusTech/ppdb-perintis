<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiayaDaftarUlang extends Model
{
    use HasFactory;

    protected $table = 'biaya_daftar_ulang';

    protected $fillable = [
        'kelas_id',
        'pilihan_pembayaran',

        'uang_pangkal',

        'uang_spp',

        'kaos_olahraga',
        'bed_lokasi_dll',
        'baju_seragam',
    ];
}
