<?php

namespace App\Http\Livewire\Pages;

use App\Models\Pendaftaran;
use Livewire\Component;

class Wawancara extends Component
{
    public function mount()
    {
        if (auth()->user()->roles->first()->name == 'siswa') {
            $pendaftar = Pendaftaran::where('user_id', auth()->id())->orderBy('created_at', 'desc')->first();
            $this->pendaftar = $pendaftar;
        }
    }

    public function render()
    {
        return view('livewire.pages.wawancara');
    }
}
