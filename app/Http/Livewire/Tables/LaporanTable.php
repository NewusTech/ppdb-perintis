<?php

namespace App\Http\Livewire\Tables;

use App\Exports\Laporan;
use App\Models\Pendaftaran;
use Carbon\Carbon;
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
            'tahun_masuk' => Filter::make('Tahun')->select([
                '' => 'Semua',
                '2024' => '2024',
                '2023' => '2023',
                '2022' => '2022',
            ]),
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
            ->when($this->getFilter('tahun_masuk'), fn ($query, $created_at) => $query->whereYear('pendaftaran.created_at', $created_at));
        return $a;
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.laporan_table';
    }
}
