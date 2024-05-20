<?php

namespace App\Http\Livewire\Tables;

use App\Exports\Laporan;
use App\Models\Pendaftaran;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class LaporanTable extends DataTableComponent
{
    public $kelas_id;
    public $keterangan;
    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';

    // public array $filterNames = [
    //     'jenis_kelamin' => 'Jenis Kelamin',
    //     'kelas_id' => 'Kelas',
    // ];

    public array $bulkActions = [
        'exportSelected' => 'Export',
    ];

    public function filters(): array
    {
        return [
            'kelas_id' => Filter::make('Kelas')
                ->multiSelect([
                    1 => 'Executive',
                    2 => 'Reguler AC',
                    3 => 'Reguler Non Ac',
                ]),
            'status_pengisian_formulir' => Filter::make('Status Pengisian Formulir')
                ->select([
                    '' => 'Semua',
                    2 => 'Belum',
                    1 => 'Sudah',
                ]),
            'status_wawancara' => Filter::make('Status Wawancara')
                ->select([
                    '' => 'Semua',
                    2 => 'Belum',
                    1 => 'Sudah',
                ]),
            'status_daftar_ulang' => Filter::make('Status Daftar Ulang')
                ->select([
                    '' => 'Semua',
                    2 => 'Belum',
                    1 => 'Sudah',
                ]),
            'status_pengisian_biodata' => Filter::make('Status Pengisian Biodata')
                ->select([
                    '' => 'Semua',
                    2 => 'Belum',
                    1 => 'Sudah',
                ]),
            'from_date' => Filter::make('Dari Tanggal')
                ->date([
                    'max' => now()->format('Y-m-d'),
                ]),
            'to_date' => Filter::make('Sampai Tanggal')
                ->date([
                    'min' => isset($this->filters['from_date']) && $this->filters['from_date'] ? $this->filters['from_date'] : '',
                    'max' => now()->format('Y-m-d'),
                ])
        ];
    }


    public function exportSelected()
    {
        if ($this->selectedRowsQuery->count() > 0) {
            $name_file = 'Jumlah Pendaftar.xlsx';
            // dd($this->selectedRowsQuery->get());
            return Excel::download(new Laporan($this->selectedRowsQuery), $name_file);
        } else {
            $this->emit('noSelected');
        }
    }

    public function columns(): array
    {
        return [
            Column::make('No Pendaftaran', 'no_pendaftaran')
                ->searchable()
                ->sortable(),
            Column::make('Name', 'name')
                ->searchable()
                ->sortable(),
            Column::make('Username', 'username')
                ->searchable()
                ->sortable(),
            Column::make('Tanggal Pendaftaran', 'pendaftaran.created_at')
                ->searchable()
                ->sortable(),
            Column::make('Kelas', 'kelas.id')
                ->searchable()
                ->sortable(),
            Column::make('Jurusan', 'jurusan')
                ->searchable()
                ->sortable(),
            Column::make('Pengisian Formulir'),
            Column::make('Wawancara'),
            Column::make('Daftar Ulang'),
            Column::make('Pengisian Biodata'),
        ];
    }

    public function query(): Builder
    {
        $a =  Pendaftaran::query()
            ->join('users', 'users.id', '=', 'pendaftaran.user_id')
            ->join('kelas', 'kelas.id', '=', 'pendaftaran.kelas_id')
            ->select('pendaftaran.*', 'users.name', 'users.username', 'kelas.jenis_kelas')
            ->when($this->getFilter('status_pengisian_formulir'), function ($query) {
                if ($this->getFilter('status_pengisian_formulir') === 1) {
                    $query = $query->whereNotNull('status_pengisian_formulir');
                } else {
                    $query = $query->whereNull('status_pengisian_formulir');
                }
            })
            ->when($this->getFilter('status_wawancara'), function ($query) {
                if ($this->getFilter('status_wawancara') === 1) {
                    $query = $query->whereNotNull('status_wawancara');
                } else {
                    $query = $query->whereNull('status_wawancara');
                }
            })
            ->when($this->getFilter('status_daftar_ulang'), function ($query) {
                if ($this->getFilter('status_daftar_ulang') === 1) {
                    $query = $query->whereNotNull('status_daftar_ulang');
                } else {
                    $query = $query->whereNull('status_daftar_ulang');
                }
            })
            ->when($this->getFilter('status_pengisian_biodata'), function ($query) {
                if ($this->getFilter('status_pengisian_biodata') === 1) {
                    $query = $query->whereNotNull('status_pengisian_biodata');
                } else {
                    $query = $query->whereNull('status_pengisian_biodata');
                }
            })
            ->when($this->getFilter('kelas_id'), fn ($query, $kelas_id) => $query->whereIn('kelas_id', $kelas_id))
            ->when($this->getFilter('from_date'), fn ($query, $created_at) => $query->whereDate('pendaftaran.created_at', '>=', $created_at))
            ->when($this->getFilter('to_date'), fn ($query, $created_at) => $query->whereDate('pendaftaran.created_at', '<=', $created_at));

        return $a;
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.laporan_table';
    }
}
