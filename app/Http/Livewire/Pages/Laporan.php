<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

class Laporan extends Component
{

    protected $listeners = [
        'noSelected' => 'noSelected',
    ];

    public function noSelected()
    {
        session()->flash('error', 'Tidak ada data yang dipilih');
    }

    public function render()
    {
        return view('livewire.pages.laporan');
    }
}
