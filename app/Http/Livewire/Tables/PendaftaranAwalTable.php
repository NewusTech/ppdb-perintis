<?php

namespace App\Http\Livewire\Tables;

use App\Models\Pendaftaran;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Illuminate\Support\Facades\DB;

class PendaftaranAwalTable extends DataTableComponent
{
    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';

    public $tahun;

    protected $listeners = [
        'tabelPendaftaranAwal' => '$refresh',
    ];

    public array $filterNames = [
        'kelas_id' => 'Kelas',
    ];

    public function mount($tahun =  null)
    {
        $this->tahun = $tahun;
    }
    public function filters(): array
    {
        return [
            'kelas_id' => Filter::make('Kelas')
                ->multiSelect([
                    1 => 'Executive',
                    2 => 'Reguler AC',
                    3 => 'Reguler Non Ac',
                ]),

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
            Column::make('No Pendaftaran', 'no_pendaftaran')
                ->sortable()
                ->searchable(),
            Column::make('Nama Lengkap', 'users.name')
                ->sortable()
                ->searchable(),
            Column::make('NISN', 'users.username')
                ->sortable()
                ->searchable(),
            Column::make("Kelas", 'kelas.jenis_kelas')
                ->sortable()
                ->searchable(),
            Column::make("Tanggal Pendaftaran", 'created_at')
                ->sortable()
                ->searchable(),
            Column::make('Aksi', 'id')
        ];
    }

    public function query(): Builder
    {
        $query = Pendaftaran::query()
            ->join('users', 'users.id', '=', 'pendaftaran.user_id')
            ->join('kelas', 'kelas.id', '=', 'pendaftaran.kelas_id')
            ->select('pendaftaran.*', 'users.name', 'users.username', 'kelas.jenis_kelas')
            ->when($this->getFilter('kelas_id'), fn ($query, $kelas_id) => $query->whereIn('kelas_id', $kelas_id))
            ->when($this->getFilter('tahun_masuk'), fn ($query, $created_at) => $query->whereYear('pendaftaran.created_at', $created_at));

        if ($this->tahun) {
            $query->whereYear('pendaftaran.created_at', $this->tahun);
        }

        return $query;
    }

    public $pendaftaran_id = '', $nama_lengkap = '', $no_pendaftaran = '', $username = '', $token = '', $password = '', $kelas = '', $nisn = '';

    public function rules($id)
    {
        $user_id = Pendaftaran::find($id)->user_id;
        $id = User::find($user_id)->id;
        return [
            'nama_lengkap' => 'required',
            'nisn' => 'required|numeric|unique:users,username,' . $id,
            'kelas' => 'required',
        ];
    }

    public function cancel()
    {
        $this->resetValidation();
    }

    public function generatePassword()
    {
        $pool = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($pool, 5)), 0, 5);
    }

    public function edit($id)
    {
        $pendaftar = Pendaftaran::join('users', 'users.id', '=', 'pendaftaran.user_id')
            ->join('kelas', 'kelas.id', '=', 'pendaftaran.kelas_id')
            ->select('pendaftaran.*', 'users.name as nama_lengkap', 'users.username as nisn', 'users.token as token', 'kelas.jenis_kelas as kelas')
            ->where('pendaftaran.id', $id)
            ->first();
        $this->pendaftaran_id = $id;
        $this->no_pendaftaran = $pendaftar->no_pendaftaran;
        $this->nama_lengkap = $pendaftar->nama_lengkap;
        $this->nisn = $pendaftar->nisn;
        $this->kelas = $pendaftar->kelas_id;
        $this->token = $pendaftar->token;
    }

    public function detail($id)
    {
        $pendaftar = Pendaftaran::join('users', 'users.id', '=', 'pendaftaran.user_id')
            ->join('kelas', 'kelas.id', '=', 'pendaftaran.kelas_id')
            ->select('pendaftaran.*', 'users.name as nama_lengkap', 'users.username as nisn', 'users.token as token', 'kelas.jenis_kelas as kelas')
            ->where('pendaftaran.id', $id)
            ->first();
        $this->pendaftaran_id = $id;
        $this->no_pendaftaran = $pendaftar->no_pendaftaran;
        $this->nama_lengkap = $pendaftar->nama_lengkap;
        $this->nisn = $pendaftar->nisn;
        $this->kelas = $pendaftar->kelas_id;
        $this->token = $pendaftar->token;
    }

    public function update()
    {
        // dd($this->pendaftaran_id);
        $this->validate($this->rules($this->pendaftaran_id));

        try {
            $pendaftar = Pendaftaran::find($this->pendaftaran_id);
            $user = User::find($pendaftar->user_id);

            $user->name = $this->nama_lengkap;
            $user->username = $this->nisn;

            if ($this->password == 1) {
                $this->password = $this->generatePassword();
                $user->token = $this->password;
                $user->password = bcrypt($this->password);
            } else {
                $this->password = $user->token;
            }
            $user->update();

            if ($this->kelas != $pendaftar->kelas_id) {
                if ($this->kelas == 1) {
                    $pendaftar = Pendaftaran::where('kelas_id', 1)
                        ->whereYear('created_at', date('Y'))
                        ->orderBy('no_pendaftaran', 'desc')
                        ->first();
                    if ($pendaftar == null) {
                        $no_pendaftaran = 1;
                    } else {
                        $no_pendaftaran = $pendaftar->no_pendaftaran + 1;
                    }
                } elseif ($this->kelas == 2) {
                    $pendaftar = Pendaftaran::where('kelas_id', 2)
                        ->whereYear('created_at', date('Y'))
                        ->orderBy('no_pendaftaran', 'desc')
                        ->first();
                    if ($pendaftar == null) {
                        $no_pendaftaran = 1;
                    } else {
                        $no_pendaftaran = $pendaftar->no_pendaftaran + 1;
                    }
                } else {
                    $pendaftar = Pendaftaran::where('kelas_id', 3)
                        ->whereYear('created_at', date('Y'))
                        ->orderBy('no_pendaftaran', 'desc')
                        ->first();
                    if ($pendaftar == null) {
                        $no_pendaftaran = 1;
                    } else {
                        $no_pendaftaran = $pendaftar->no_pendaftaran + 1;
                    }
                }

                $pendaftar = Pendaftaran::find($this->pendaftaran_id);
                $pendaftar->kelas_id = $this->kelas;
                $pendaftar->no_pendaftaran = $no_pendaftaran;
                $pendaftar->update();
            } else {
                $pendaftar = Pendaftaran::find($this->pendaftaran_id);
                $pendaftar->kelas_id = $this->kelas;
                $pendaftar->update();
            }

            session()->flash('success', 'Pendaftaran siswa berhasil diubah');
            $this->edit($this->pendaftaran_id);
        } catch (\Exception $e) {
            session()->flash('error', 'Pendaftaran siswa gagal diubah');
        }
    }

    public function delete($id)
    {
        // dd($id);
        // $this->validate($this->rules($id));

        try {
            $pendaftar = Pendaftaran::find($id);

            DB::table('pendaftaran')->where('id', $id)->delete();

            DB::table('users')->where('id', $pendaftar->user_id)->delete();

            session()->flash('success_delete', 'Pendaftaran siswa berhasil dihapus');
        } catch (\Exception $e) {
            session()->flash('error_delete', 'Pendaftaran siswa gagal dihapus');
        }
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.pendaftaran_awal_table';
    }
}
