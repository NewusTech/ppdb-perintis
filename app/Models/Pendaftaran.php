<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';

    protected $fillable = [
        'user_id',
        'no_pendaftaran',
        'kelas_id',
        'jurusan',
        'catatan',

        // keterangan pribadi
        'nama_panggilan',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'nik',
        'kewarganegaraan',
        'anak_ke',
        'dari_bersaudara',
        'status_dalam_keluarga',
        'jumlah_saudara_kandung',

        'bahasa_sehari_hari',
        'asal_sekolah',
        'alamat_asal_sekolah',
        'no_ijazah',
        'tahun_ijazah',
        'no_skhu',
        'tahun_skhu',

        // keterangan tempat tinggal
        'no_hp_siswa',
        'alamat_lengkap',
        'alamat_tersebut',

        // keterangan kesehatan
        'golongan_darah',
        'penyakit_yang_pernah_diderita',
        'kelainan_jasmani',
        'tinggi_berat_badan',

        // keterangan orang tua
        'nama_ayah',
        'pekerjaan_ayah',
        'tempat_lahir_ayah',
        'tanggal_lahir_ayah',
        'penghasilan_ayah',

        'nama_ibu',
        'pekerjaan_ibu',
        'tempat_lahir_ibu',
        'tanggal_lahir_ibu',
        'penghasilan_ibu',

        'alamat_orang_tua',
        'no_hp_orang_tua',

        // keterangan wali
        'nama_wali',
        'pekerjaan_wali',
        'tempat_lahir_wali',
        'tanggal_lahir_wali',
        'alamat_wali',
        'no_hp_wali',
        'agama_wali',
        'status_hubungan_wali',
        'penghasilan_wali',

        // keterangan kegemaran / hobi
        'kesenian',
        'olahraga',
        'organisasi',
        'lain_lain',

        // status dan keterangan
        'angsuran',
        'lunas',
        'status_pengisian_formulir',
        'status_wawancara',
        'status_daftar_ulang',
        'status_pengisian_biodata',
        'status_verifikasi',
        'lolos_verifikasi',

        // file
        'foto',
        'formulir_pendaftaran',
        'pernyataan_siswa_baru',
        'lembar_perjanjian',
        'kwitansi_angsuran',
        'kwitansi_lunas',
        'biodata',
        'biaya_daftar_ulang_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
