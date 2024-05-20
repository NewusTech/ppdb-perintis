<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class Laporan implements FromCollection, WithHeadings
{
    use Exportable;

    protected $selectedRowsQuery;

    function __construct($selectedRowsQuery)
    {
        $this->selectedRowsQuery = $selectedRowsQuery;
    }

    public function collection()
    {
        // dd($this->selectedRowsQuery);
        $query = $this->selectedRowsQuery->select(
            'no_pendaftaran',
            'users.name',
            'nama_panggilan',
            'users.username',
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
        )->get();
        // dd($query);
        return $query;
    }

    public function headings(): array
    {
        return [
            'No Pendaftaran',
            'Nama',
            'Nama Panggilan',
            'NISN',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Agama',
            'NIK',
            'Kewarganegaraan',
            'Anak Ke',
            'Dari Bersaudara',
            'Status Dalam Keluarga',
            'Jumlah Saudara Kandung',

            'Bahasa Sehari Hari',
            'Asal Sekolah',
            'alamat_asal_sekolah',
            'No Ijazah',
            'Tahun Ijazah',
            'No Skhu',
            'Tahun Skhu',

            // keterangan tempat tinggal
            'No Hp Siswa',
            'Alamat Lengkap',
            'Alamat Tersebut',

            // keterangan kesehatan
            'Golongan Darah',
            'Penyakit Yang Pernah Diderita',
            'Kelainan Jasmani',
            'Tinggi Berat Badan',

            // keterangan orang tua
            'Nama Ayah',
            'Pekerjaan Ayah',
            'Tempat Lahir Ayah',
            'Tanggal Lahir Ayah',
            'Penghasilan Ayah',

            'Nama Ibu',
            'Pekerjaan Ibu',
            'Tempat Lahir Ibu',
            'Tanggal Lahir Ibu',
            'Penghasilan Ibu',

            'Alamat Orang Tua',
            'No Hp Orang Tua',

            // keterangan wali
            'Nama Wali',
            'Pekerjaan Wali',
            'Tempat Lahir Wali',
            'Tanggal Lahir Wali',
            'Alamat Wali',
            'No Hp wali',
            'Agama Wali',
            'Status Hubungan Wali',
            'Penghasilan Wali',

            // keterangan kegemaran / hobi
            'Kesenian',
            'Olahraga',
            'Organisasi',
            'Lain-lain',
        ];
    }
}
