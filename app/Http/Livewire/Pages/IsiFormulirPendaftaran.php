<?php

namespace App\Http\Livewire\Pages;

use App\Models\Pendaftaran;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Component;

class IsiFormulirPendaftaran extends Component
{
    public function mount($id)
    {
        $pendaftar = Pendaftaran::with('user', 'kelas')->find($id);

        if (auth()->user()->roles->first()->name == 'siswa' && auth()->id() != $pendaftar->user_id) {
            abort(404);
        }

        $this->pendaftar = $pendaftar;
        $this->nama_lengkap = $pendaftar->user->name;
        $this->nisn = $pendaftar->user->username;
        $this->kelas = $pendaftar->kelas->jenis_kelas;
        $this->biaya_pendaftaran = $pendaftar->kelas->biaya_pendaftaran;
        $this->pendaftaran_terbilang = $pendaftar->kelas->pendaftaran_terbilang;
        $this->uang_pangkal = $pendaftar->kelas->uang_pangkal;
        $this->uang_spp = $pendaftar->kelas->uang_spp;
        $this->biaya_daftar_ulang = $pendaftar->kelas->biaya_daftar_ulang;
        $this->daftar_ulang_terbilang = $pendaftar->kelas->daftar_ulang_terbilang;

        $this->tempat_lahir = $pendaftar->tempat_lahir;
        $this->tanggal_lahir = $pendaftar->tanggal_lahir;
        $this->alamat_lengkap = $pendaftar->alamat_lengkap;
        $this->jenis_kelamin = $pendaftar->jenis_kelamin;
        $this->agama = $pendaftar->agama;
        $this->no_hp_siswa = $pendaftar->no_hp_siswa;
        $this->asal_sekolah = $pendaftar->asal_sekolah;

        $this->nama_ayah = $pendaftar->nama_ayah;
        $this->pekerjaan_ayah = $pendaftar->pekerjaan_ayah;
        $this->nama_ibu = $pendaftar->nama_ibu;
        $this->pekerjaan_ibu = $pendaftar->pekerjaan_ibu;
        $this->no_hp_orang_tua = $pendaftar->no_hp_orang_tua;
        $this->alamat_orang_tua = $pendaftar->alamat_orang_tua;

        $this->nama_wali = $pendaftar->nama_wali;
        $this->pekerjaan_wali = $pendaftar->pekerjaan_wali;
        $this->no_hp_wali = $pendaftar->no_hp_wali;
        $this->agama_wali = $pendaftar->agama_wali;
        $this->status_hubungan_wali = $pendaftar->status_hubungan_wali;
        $this->alamat_wali = $pendaftar->alamat_wali;

        $this->jurusan = $pendaftar->jurusan;
    }

    protected $rules = [
        'nama_lengkap' => 'required',
        'tempat_lahir' => 'required',
        'tanggal_lahir' => 'required',
        'alamat_lengkap' => 'required',
        'jenis_kelamin' => 'required',
        'agama' => 'required',
        'no_hp_siswa' => 'required|numeric',
        'nisn' => 'required',
        'asal_sekolah' => 'required',

        'nama_ayah' => 'required',
        'pekerjaan_ayah' => 'required',
        'nama_ibu' => 'required',
        'pekerjaan_ibu' => 'required',
        'no_hp_orang_tua' => 'required|numeric',
        'alamat_orang_tua' => 'required',

        'nama_wali' => 'nullable',
        'pekerjaan_wali' => 'nullable',
        'no_hp_wali' => 'nullable|numeric',
        'agama_wali' => 'nullable',
        'status_hubungan_wali' => 'nullable',
        'alamat_wali' => 'nullable',

        'jurusan' => 'required',

    ];

    public function updated($field)
    {
        $this->validateOnly($field, $this->rules);
    }

    public function save($id)
    {
        $this->validate($this->rules);
        try {
            $pendaftar = Pendaftaran::find($id);
            $user = User::find($pendaftar->user_id);

            $user->name = $this->nama_lengkap;
            $user->username = $this->nisn;
            $user->update();

            $pendaftar->tempat_lahir = Str::headline($this->tempat_lahir);
            $pendaftar->tanggal_lahir = $this->tanggal_lahir;
            $pendaftar->alamat_lengkap = $this->alamat_lengkap;
            $pendaftar->jenis_kelamin = $this->jenis_kelamin;
            $pendaftar->agama = $this->agama;
            $pendaftar->no_hp_siswa = $this->no_hp_siswa;

            $pendaftar->nama_ayah = $this->nama_ayah;
            $pendaftar->pekerjaan_ayah = $this->pekerjaan_ayah;
            $pendaftar->nama_ibu = $this->nama_ibu;
            $pendaftar->pekerjaan_ibu = $this->pekerjaan_ibu;
            $pendaftar->no_hp_orang_tua = $this->no_hp_orang_tua;
            $pendaftar->alamat_orang_tua = $this->alamat_orang_tua;

            $pendaftar->nama_wali = $this->nama_wali;
            $pendaftar->pekerjaan_wali = $this->pekerjaan_wali;
            $pendaftar->no_hp_wali = $this->no_hp_wali;
            $pendaftar->agama_wali = $this->agama_wali;
            $pendaftar->status_hubungan_wali = $this->status_hubungan_wali;
            $pendaftar->alamat_wali = $this->alamat_wali;

            $pendaftar->jurusan = $this->jurusan;

            $pendaftar->asal_sekolah = Str::upper($this->asal_sekolah);
            $pendaftar->status_pengisian_formulir = true;
            $pendaftar->update();
            session()->flash('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            // dd($e);
            session()->flash('error', 'Data gagal disimpan');
        }
    }

    public function cancel($id)
    {
        $this->resetValidation();
        $this->mount($id);
    }

    public function render()
    {
        return view('livewire.pages.isi-formulir-pendaftaran');
    }
}
