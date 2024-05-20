<?php

namespace App\Http\Livewire\Pages;

use App\Models\Pendaftaran;
use App\Models\User;
use Livewire\Component;

class FormulirPendaftaran extends Component
{
    public function render()
    {
        return view('livewire.pages.formulir-pendaftaran');
    }
}
