<?php

namespace App\Http\Livewire\Components;

use App\Models\BiayaDaftarUlang;
use Livewire\Component;

class FormBiayaPerlengkapan extends Component
{
    public function mount()
    {
        $biaya = BiayaDaftarUlang::get()->first();
        $this->kaos_olahraga = $biaya->kaos_olahraga;
        $this->bed_lokasi_dll = $biaya->bed_lokasi_dll;
        $this->baju_seragam = $biaya->baju_seragam;
    }

    protected $rules = [
        'kaos_olahraga' => 'required|numeric',
        'bed_lokasi_dll' => 'required|numeric',
        'baju_seragam' => 'required|numeric',
    ];

    protected $messages = [
        '*.required' => 'Wajib diisi',
        '*.numeric' => 'Inputan wajib berupa angka',
    ];

    public function updated($field)
    {
        $this->validateOnly($field, $this->rules);
    }

    public function saveBiayaPerlengkapan()
    {
        $this->validate($this->rules);
        try {
            $biaya = BiayaDaftarUlang::first();

            if ($biaya->kaos_olahraga != $this->kaos_olahraga || $biaya->bed_lokasi_dll != $this->bed_lokasi_dll || $biaya->baju_seragam != $this->baju_seragam) {
                $biaya = BiayaDaftarUlang::all();
                foreach ($biaya as $b) {
                    $b->kaos_olahraga = $this->kaos_olahraga;
                    $b->bed_lokasi_dll = $this->bed_lokasi_dll;
                    $b->baju_seragam = $this->baju_seragam;
                    $b->update();
                }
                session()->flash('success', 'Biaya berhasil diubah');
            } else {
                session()->flash('info', 'Tidak ada data yang diubah');
            }
        } catch (\Throwable $th) {
            session()->flash('error', 'Gagal mengubah biaya');
        }
    }

    public function render()
    {
        return view('livewire.components.form-biaya-perlengkapan');
    }
}
