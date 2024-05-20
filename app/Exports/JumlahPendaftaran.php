<?php

namespace App\Exports;

use App\Models\Pendaftaran;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class JumlahPendaftaran implements FromCollection, WithHeadings
{
    use Exportable;

    protected $from_date;
    protected $to_date;

    function __construct($from_date, $to_date)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    public function collection()
    {
        $query =  Pendaftaran::query()
            ->join('users', 'users.id', '=', 'pendaftaran.user_id')
            ->join('kelas', 'kelas.id', '=', 'pendaftaran.kelas_id')
            ->select('users.name', 'users.username', 'kelas.jenis_kelas', 'pendaftaran.tempat_lahir', 'pendaftaran.tanggal_lahir', 'pendaftaran.asal_sekolah', DB::raw("DATE_FORMAT(pendaftaran.created_at, '%d-%m-%Y')"))
            ->whereBetween('pendaftaran.created_at', [$this->from_date, $this->to_date])->get();
        // ->first();
        // dd($query);
        return $query;
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NISN',
            'Kelas',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Asal Sekolah',
            'Tanggal Daftar',
        ];
    }
}
