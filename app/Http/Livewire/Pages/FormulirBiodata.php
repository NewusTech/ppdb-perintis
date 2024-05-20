<?php

namespace App\Http\Livewire\Pages;

use App\Models\Biodata;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormulirBiodata extends Component
{
    use WithFileUploads;

    public Pendaftaran $pendaftar;
    public $foto;
    public $lolos_verifikasi;

    public function mount($id)
    {
        $this->pendaftar = Pendaftaran::with('user', 'kelas')->findOrFail($id);
        if ($this->pendaftar->status_daftar_ulang === null) {
            abort(404);
        }
        $this->lolos_verifikasi = $this->pendaftar->lolos_verifikasi;
    }

    protected $rules = [
        'foto' => 'nullable|image|mimes:jpeg,png,jpg',
        'pendaftar.user.name' => 'required',
        'pendaftar.nama_panggilan' => 'required',
        'pendaftar.jenis_kelamin' => 'required',
        'pendaftar.tempat_lahir' => 'required',
        'pendaftar.tanggal_lahir' => 'required',
        'pendaftar.nik' => 'required|numeric',
        'pendaftar.agama' => 'required',
        'pendaftar.kewarganegaraan' => 'required',
        'pendaftar.anak_ke' => 'required',
        'pendaftar.dari_bersaudara' => 'required',
        'pendaftar.status_dalam_keluarga' => 'required',
        'pendaftar.jumlah_saudara_kandung' => 'required',
        'pendaftar.bahasa_sehari_hari' => 'required',
        'pendaftar.asal_sekolah' => 'required',
        'pendaftar.alamat_asal_sekolah' => 'required',
        'pendaftar.user.username' => 'required|numeric',
        'pendaftar.no_ijazah' => 'nullable',
        'pendaftar.tahun_ijazah' => 'nullable|numeric',
        'pendaftar.no_skhu' => 'nullable',
        'pendaftar.tahun_skhu' => 'nullable|numeric',

        // keterangan tempat tinggal
        'pendaftar.alamat_lengkap' => 'required',
        'pendaftar.no_hp_siswa' => 'required|numeric',
        'pendaftar.alamat_tersebut' => 'required',

        // keterangan kesehatan
        'pendaftar.golongan_darah' => 'required',
        'pendaftar.penyakit_yang_pernah_diderita' => 'required',
        'pendaftar.kelainan_jasmani' => 'required',
        'pendaftar.tinggi_berat_badan' => 'required',

        // keterangan orang tua/wali
        'pendaftar.nama_ayah' => 'required',
        'pendaftar.pekerjaan_ayah' => 'required',
        'pendaftar.tempat_lahir_ayah' => 'required',
        'pendaftar.tanggal_lahir_ayah' => 'required',
        'pendaftar.penghasilan_ayah' => 'required',

        'pendaftar.nama_ibu' => 'required',
        'pendaftar.pekerjaan_ibu' => 'required',
        'pendaftar.tempat_lahir_ibu' => 'required',
        'pendaftar.tanggal_lahir_ibu' => 'required',
        'pendaftar.penghasilan_ibu' => 'required',

        'pendaftar.alamat_orang_tua' => 'required',
        'pendaftar.no_hp_orang_tua' => 'required',

        'pendaftar.nama_wali' => 'nullable',
        'pendaftar.pekerjaan_wali' => 'nullable',
        'pendaftar.tempat_lahir_wali' => 'nullable',
        'pendaftar.tanggal_lahir_wali' => 'nullable',
        'pendaftar.alamat_wali' => 'nullable',
        'pendaftar.no_hp_wali' => 'nullable|numeric',
        'pendaftar.status_hubungan_wali' => 'nullable',
        'pendaftar.penghasilan_wali' => 'nullable',

        // keterangan kegemaran / hobi
        'pendaftar.kesenian' => 'required',
        'pendaftar.olahraga' => 'required',
        'pendaftar.organisasi' => 'required',
        'pendaftar.lain_lain' => 'required',
    ];

    protected $messages = [
        '*.*.required' => 'Wajib di isi.',
        '*.*.*.required' => 'Wajib di isi.',
        '*.*.numeric' => 'Wajib di isi dengan angka.',
        '*.*.*.numeric' => 'Wajib di isi dengan angka.',
    ];

    public function updated($field)
    {
        $this->validateOnly($field, $this->rules);
    }

    public function cancel($id)
    {
        $this->resetValidation();
        $this->mount($id);
    }

    public function deleteFoto()
    {
        $this->foto = null;
    }

    public function save()
    {
        $this->validate($this->rules);
        $role = auth()->user()->roles->first()->name;
        if ($role === 'super admin' || $role === 'admin verifikasi') {
            $this->validate([
                'lolos_verifikasi' => 'required',
            ]);
        }

        if ($this->pendaftar->tanggal_lahir_wali == "") {
            $this->pendaftar->tanggal_lahir_wali = null;
        }

        try {
            $this->pendaftar->save();
            if (isset($this->foto)) {
                $path = 'berkas/' . $this->pendaftar->id;
                File::delete(Storage::path('public/' . $this->pendaftar->foto));
                $this->pendaftar->foto = $this->foto->store($path, 'public');
                $this->pendaftar->update();
            }

            if ($role == 'super admin' || $role == 'admin verifikasi') {
                $this->pendaftar->status_pengisian_biodata = 1;
                $this->pendaftar->status_verifikasi = 1;
                $this->pendaftar->lolos_verifikasi = $this->lolos_verifikasi;
            } else {
                $this->pendaftar->status_pengisian_biodata = 1;
                $this->pendaftar->status_verifikasi = 1;
                $this->pendaftar->lolos_verifikasi = null;
            }
            $this->pendaftar->update();
            session()->flash('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            // dd($e);
            session()->flash('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    public function render()
    {
        return view('livewire.pages.formulir-biodata');
    }
}
