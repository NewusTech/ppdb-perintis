<?php

namespace App\Http\Livewire\Tables;

use App\Models\Pendaftaran;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class DaftarSiswaTable extends DataTableComponent
{
    public $kelas_id;
    public $keterangan = '';

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
        return [
            Column::make('Name', 'name')
                ->searchable()
                ->sortable(),
            Column::make('Username', 'username')
                ->searchable()
                ->sortable(),
            Column::make('Jurusan', 'jurusan')
                ->searchable()
                ->sortable(),
            Column::make('Pembayaran', 'biaya_daftar_ulang.pilihan_pembayaran')
                ->searchable()
                ->sortable(),
            Column::make('Foto'),
            Column::make('Aksi', 'id'),
        ];
    }

    public function query(): Builder
    {
        $a =  Pendaftaran::query()
            ->join('users', 'users.id', '=', 'pendaftaran.user_id')
            ->join('kelas', 'kelas.id', '=', 'pendaftaran.kelas_id')
            ->select('pendaftaran.*', 'users.name', 'users.username')
            ->where('kelas_id', '=', $this->kelas_id)
            ->where('status_daftar_ulang', '=', 1)
            ->when($this->getFilter('tahun_masuk'), fn ($query, $created_at) => $query->whereYear('pendaftaran.created_at', $created_at));

        return $a;
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.daftar_siswa_table';
    }
}
