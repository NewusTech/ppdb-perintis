<?php

namespace App\Http\Livewire\Tables;

use App\Models\Pendaftaran;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class DaftarUlangTable extends DataTableComponent
{
    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';
    public $kelas_id,$keterangan;

    public function columns(): array
    {
        return [
            Column::make('No Pendaftaran', 'no_pendaftaran')
                ->searchable()
                ->sortable(),
            Column::make('Nama', 'users.name')
                ->searchable()
                ->sortable(),
            Column::make('NISN', 'users.username')
                ->searchable()
                ->sortable(),
            Column::make('Tanggal Pendaftaran', 'created_at')
                ->searchable()
                ->sortable(),
            Column::make('Jurusan', 'jurusan')
                ->searchable()
                ->sortable(),
            Column::make('Status Daftar Ulang', 'status_daftar_ulang')
                ->sortable(),
            Column::make('Pembayaran'),
            Column::make('Aksi', 'id'),
        ];
    }

    public function query(): Builder
    {
        if (
            auth()
            ->user()
            ->roles->first()->name == 'siswa'
        ) {
            return Pendaftaran::query()
                ->join('users', 'users.id', '=', 'pendaftaran.user_id')
                ->join('kelas', 'kelas.id', '=', 'pendaftaran.kelas_id')
                ->select('pendaftaran.*', 'users.name', 'users.username', 'kelas.jenis_kelas')
                ->where('user_id', auth()->id())
                ->where('pendaftaran.kelas_id', $this->kelas_id)
                ->where('status_wawancara', 1);
            // ->where('lembar_perjanjian', '!=', null);
        }
        $a = Pendaftaran::query()
            ->join('users', 'users.id', '=', 'pendaftaran.user_id')
            ->join('kelas', 'kelas.id', '=', 'pendaftaran.kelas_id')
            ->select('pendaftaran.*', 'users.name', 'users.username', 'kelas.jenis_kelas')
            ->where('pendaftaran.kelas_id', $this->kelas_id)
            ->where('status_wawancara', 1);
        // dd($a);
        return $a;
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.daftar_ulang_table';
    }
}
