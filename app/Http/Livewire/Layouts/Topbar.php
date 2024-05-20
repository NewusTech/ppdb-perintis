<?php

namespace App\Http\Livewire\Layouts;

use Livewire\Component;

class Topbar extends Component
{
    protected $listeners = [
        'refreshHeader' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.layouts.topbar');
    }
}
