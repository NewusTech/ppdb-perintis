<?php

namespace App\Http\Livewire\Tables;

use App\Models\Pendaftaran;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class BiodataTable extends DataTableComponent
{
    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';
    public $kelas_id;
    public $keterangan;


    public function columns(): array
    {
        if (auth()->user()->roles->first()->name === 'siswa') {
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
                Column::make('Pembayaran'),
                Column::make('Pengisian Biodata', 'status_pengisian_biodata')
                    ->searchable()
                    ->sortable(),
                Column::make('Lolos Verifikasi', 'lolos_verifikasi')
                    ->searchable()
                    ->sortable(),
                Column::make('Aksi', 'id'),
            ];
        }

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
            Column::make('Pembayaran'),
            Column::make('Pengisian Biodata', 'status_pengisian_biodata')
                ->searchable()
                ->sortable(),
            Column::make('Lolos Verifikasi', 'lolos_verifikasi')
                ->searchable()
                ->sortable(),
            Column::make('File Biodata'),
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
                ->where('kelas.id', $this->kelas_id)
                ->where('status_daftar_ulang', true);
        }
        return Pendaftaran::query()
            ->join('users', 'users.id', '=', 'pendaftaran.user_id')
            ->join('kelas', 'kelas.id', '=', 'pendaftaran.kelas_id')
            ->select('pendaftaran.*', 'users.name', 'users.username', 'kelas.jenis_kelas')
            ->where('kelas.id', $this->kelas_id)
            ->where('status_daftar_ulang', true);
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.biodata_table';
    }
}
