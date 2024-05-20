<?php

namespace App\Http\Livewire\Layouts;

use Livewire\Component;

class Sidebar extends Component
{
    protected $listeners = [
        'sidebar' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.layouts.sidebar');
    }
}
