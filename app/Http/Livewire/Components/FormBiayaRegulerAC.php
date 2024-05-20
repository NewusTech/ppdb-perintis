<?php

namespace App\Http\Livewire\Components;

use App\Models\BiayaDaftarUlang;
use App\Models\Kelas;
use Livewire\Component;

class FormBiayaRegulerAC extends Component
{
    public function mount()
    {
        $biaya_lunas = BiayaDaftarUlang::find(2);
        $biaya_angsuran = BiayaDaftarUlang::find(3);
        $kelas = Kelas::find(2);

        $this->biaya_pendaftaran = $kelas->biaya_pendaftaran;
        $this->uang_pangkal_lunas = $biaya_lunas->uang_pangkal;
        $this->uang_pangkal_angsuran = $biaya_angsuran->uang_pangkal;
        $this->uang_spp = $biaya_lunas->uang_spp;
    }

    protected $rules = [
        'biaya_pendaftaran' => 'required|numeric',
        'uang_pangkal_lunas' => 'required|numeric',
        'uang_pangkal_angsuran' => 'required|numeric',
        'uang_spp' => 'required|numeric',
    ];

    protected $messages = [
        '*.required' => 'Wajib diisi',
        '*.numeric' => 'Inputan wajib berupa angka',
    ];

    public function updated($field)
    {
        $this->validateOnly($field, $this->rules);
    }

    public function save()
    {
        $this->validate($this->rules);
        try {
            $biaya_lunas = BiayaDaftarUlang::find(2);
            $biaya_angsuran = BiayaDaftarUlang::find(3);
            $kelas = Kelas::find(2);

            if ($kelas->biaya_pendaftaran != $this->biaya_pendaftaran || $biaya_lunas->uang_pangkal != $this->uang_pangkal_lunas || $biaya_lunas->uang_spp != $this->uang_spp || $biaya_angsuran->uang_pangkal != $this->uang_pangkal_angsuran) {
                $kelas->biaya_pendaftaran = $this->biaya_pendaftaran;
                $kelas->update();
                $biaya_lunas->uang_pangkal = $this->uang_pangkal_lunas;
                $biaya_lunas->uang_spp = $this->uang_spp;
                $biaya_lunas->update();
                $biaya_angsuran->uang_pangkal = $this->uang_pangkal_angsuran;
                $biaya_angsuran->uang_spp = $this->uang_spp;
                $biaya_angsuran->update();
                session()->flash('success', 'Biaya berhasil diubah');
            } else {
                session()->flash('info', 'Tidak ada data yang diubah');
            }
        } catch (\Throwable $th) {
            session()->flash('error', 'Biaya gagal diubah');
        }
    }

    public function cancel()
    {
        $this->mount();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.components.form-biaya-reguler-a-c');
    }
}
