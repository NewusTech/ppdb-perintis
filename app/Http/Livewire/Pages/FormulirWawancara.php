<?php

namespace App\Http\Livewire\Pages;

use App\Models\Pendaftaran;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormulirWawancara extends Component
{
    use WithFileUploads;
    public $foto;

    public function checkRole($id)
    {

        $pendaftar = Pendaftaran::find($id);
        if (auth()->user()->roles->first()->name === 'siswa' && auth()->id() != $pendaftar->user_id) {
            abort(404);
        } elseif (auth()->user()->roles->first()->name === 'admin pendaftaran awal' || $pendaftar->status_pengisian_formulir === null) {
            abort(404);
        }
    }

    public function mount($id)
    {
        $this->checkRole($id);
        $pendaftar = Pendaftaran::with('user', 'kelas')->find($id);

        $this->pendaftar = $pendaftar;
        $this->nama_lengkap = $pendaftar->user->name;
        $this->kelas = $pendaftar->kelas->jenis_kelas;

        $this->tempat_lahir = $pendaftar->tempat_lahir;
        $this->tanggal_lahir = $pendaftar->tanggal_lahir;
        $this->jenis_kelamin = $pendaftar->jenis_kelamin;
        $this->agama = $pendaftar->agama;

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
        $this->catatan = $pendaftar->catatan;
        $this->status_wawancara = $pendaftar->status_wawancara;
    }

    protected $rulesAdmin = [
        'foto' => 'nullable|image|mimes:jpeg,png,jpg',
        'nama_lengkap' => 'required',

        'tempat_lahir' => 'required',
        'tanggal_lahir' => 'required',
        'jenis_kelamin' => 'required',
        'agama' => 'required',

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
        'catatan' => 'required',
        'status_wawancara' => 'required',
    ];

    protected $rulesSiswa = [
        'foto' => 'nullable|image|mimes:jpeg,png,jpg',
        'nama_lengkap' => 'required',

        'tempat_lahir' => 'required',
        'tanggal_lahir' => 'required',
        'jenis_kelamin' => 'required',
        'agama' => 'required',

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
        if (auth()->user()->roles->first()->name === 'siswa') {
            $this->validateOnly($field, $this->rulesSiswa);
        } else {
            $this->validateOnly($field, $this->rulesAdmin);
        }
    }

    public function cancel($id)
    {
        $this->resetValidation();
        $this->mount($id);
    }

    public function deleteFoto()
    {
        $this->foto = null;
        $this->resetValidation();
    }

    public function save($id)
    {
        if (auth()->user()->roles->first()->name === 'siswa') {
            $this->validate($this->rulesSiswa);
        } else {
            $this->validate($this->rulesAdmin);
        }

        try {
            $pendaftar = Pendaftaran::with('user')->find($id);

            if (isset($this->foto) === true) {
                $path = 'berkas/' . $pendaftar->id;
                $pendaftar->foto = $this->foto->store($path, 'public');
            }

            $pendaftar->user->name = $this->nama_lengkap;
            $pendaftar->user->update();

            $pendaftar->tempat_lahir = $this->tempat_lahir;
            $pendaftar->tanggal_lahir = $this->tanggal_lahir;
            $pendaftar->jenis_kelamin = $this->jenis_kelamin;
            $pendaftar->agama = $this->agama;
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
            $pendaftar->catatan = $this->catatan;
            $pendaftar->status_wawancara = $this->status_wawancara;
            $pendaftar->update();
            session()->flash('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            dd($e);
            // session()->flash('error', 'Data gagal disimpan');
        }
    }

    public function render()
    {
        return view('livewire.pages.formulir-wawancara');
    }
}
