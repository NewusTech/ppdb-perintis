<?php

namespace App\Http\Livewire\Components\TataTertib;

use App\Models\TataTertib;
use Livewire\Component;

class TataTertib2 extends Component
{
    public $tata_tertib;

    public function mount()
    {
        $this->tata_tertib = TataTertib::find(2)->desc;
    }

    protected $rules = [
        'tata_tertib' => 'required',
    ];

    protected $messages = [
        'tata_tertib.required' => 'Kolom tata tertib wajib diisi',
    ];

    public function updated()
    {
        $this->validate($this->rules);
    }

    public function save()
    {
        $this->validate($this->rules);
        $tata_tertib2 = TataTertib::find(2);
        $tata_tertib2->desc = $this->tata_tertib;
        $tata_tertib2->update();

        redirect()->to('/tata-tertib')->with('success', 'Tata tertib berhasil diubah');
    }

    public function render()
    {
        return view('livewire.components.tata-tertib.tata-tertib2');
    }
}
