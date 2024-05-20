<?php

namespace App\Http\Livewire\Components;

use App\Models\Pendaftaran;
use App\Models\User;
use Livewire\Component;

class FormPendaftaranAwalSiswaBaru extends Component
{
    public $nama, $nisn, $token, $password, $kelas;

    protected $rules = [
        'nama' => 'required',
        'nisn' => 'required|numeric|unique:users,username',
        'kelas' => 'required',
    ];

    public function updated($field)
    {
        $this->validateOnly($field, $this->rules);
    }

    public function cancel()
    {
        $this->reset();
        $this->resetValidation();
    }

    public function generatePassword()
    {
        $this->validate($this->rules);
        $pool = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($pool, 5)), 0, 5);
    }

    public function create()
    {
        $this->validate($this->rules);
        $this->password = $this->generatePassword();

        try {
            $siswa = new User();
            $siswa->name = $this->nama;
            $siswa->username = $this->nisn;
            $siswa->token = $this->password;
            $siswa->password = bcrypt($this->password);
            $siswa->save();
            $siswa->assignRole('siswa');

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

            $pendaftar = new Pendaftaran();
            $pendaftar->user_id = $siswa->id;
            $pendaftar->no_pendaftaran = $no_pendaftaran;
            $pendaftar->kelas_id = $this->kelas;
            $pendaftar->save();

            session()->flash('success', [
                'status' => 'Pendaftaran siswa berhasil',
                'no_pendaftaran' => $pendaftar->no_pendaftaran,
                'nama' => $siswa->name,
                'nisn' => $siswa->username,
                'kelas' => $this->kelas,
                'password' => $this->password
            ]);
            $this->cancel();
            $this->emit('tabelPendaftaranAwal');
        } catch (\Exception $e) {
            session()->flash('error', 'Pendaftaran siswa gagal');
        }
    }

    public function render()
    {
        return view('livewire.components.form-pendaftaran-awal-siswa-baru');
    }
}
