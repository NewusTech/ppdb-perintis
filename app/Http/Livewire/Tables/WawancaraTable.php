<?php

namespace App\Http\Livewire\Tables;

use App\Models\Pendaftaran;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class WawancaraTable extends DataTableComponent
{
    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';
    public $kelas_id;

    public function filters(): array
    {
        return [
            'tahun_masuk' => Filter::make('Tahun')->select([
                '' => 'Semua',
                '2024' => '2024',
                '2023' => '2023',
                '2022' => '2022',
            ]),
        ];
    }

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
                Column::make('Status Wawancara', 'status_wawancara')
                    ->searchable()
                    ->sortable(),
                Column::make('Jurusan', 'jurusan')
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
            Column::make('Status Wawancara', 'status_wawancara')
                ->searchable()
                ->sortable(),
            Column::make('Jurusan', 'jurusan')
                ->searchable()
                ->sortable(),
            Column::make('Pernyataan Siswa Baru', 'pernyataan_siswa_baru'),
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
                ->where('pendaftaran.formulir_pendaftaran', '!=', null)
                ->when($this->getFilter('tahun_masuk'), fn ($query, $created_at) => $query->whereYear('pendaftaran.created_at', $created_at));
        }
        return Pendaftaran::query()
            ->join('users', 'users.id', '=', 'pendaftaran.user_id')
            ->join('kelas', 'kelas.id', '=', 'pendaftaran.kelas_id')
            ->select('pendaftaran.*', 'users.name', 'users.username', 'kelas.jenis_kelas')
            ->where('kelas.id', $this->kelas_id)
            ->where('pendaftaran.formulir_pendaftaran', '!=', null)
            ->when($this->getFilter('tahun_masuk'), fn ($query, $created_at) => $query->whereYear('pendaftaran.created_at', $created_at));
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.wawancara_table';
    }
}
