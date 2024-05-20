<?php

namespace App\Http\Livewire\Components;

use App\Models\BiayaDaftarUlang;
use App\Models\Kelas;
use Livewire\Component;

class FormBiayaExecutive extends Component
{
    public function mount()
    {
        $biaya = BiayaDaftarUlang::get()->first();
        $kelas = Kelas::find(1);
        $this->biaya_pendaftaran = $kelas->biaya_pendaftaran;
        $this->uang_pangkal = $biaya->uang_pangkal;
        $this->uang_spp = $biaya->uang_spp;
    }

    protected $rules = [
        'biaya_pendaftaran' => 'required|numeric',
        'uang_pangkal' => 'required|numeric',
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
            $biaya = BiayaDaftarUlang::get()->first();
            $kelas = Kelas::find(1);

            if ($kelas->biaya_pendaftaran != $this->biaya_pendaftaran || $biaya->uang_pangkal != $this->uang_pangkal || $biaya->uang_spp != $this->uang_spp) {
                $kelas->biaya_pendaftaran = $this->biaya_pendaftaran;
                $biaya->uang_pangkal = $this->uang_pangkal;
                $biaya->uang_spp = $this->uang_spp;
                $kelas->update();
                $biaya->update();
                session()->flash('success', 'Biaya berhasil diubah');
            } else {
                session()->flash('info', 'Tidak ada data yang diubah');
            }
        } catch (\Throwable $th) {
            session()->flash('error', 'Gagal mengubah biaya');
        }
    }

    public function cancel()
    {
        $this->mount();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.components.form-biaya-executive');
    }
}
