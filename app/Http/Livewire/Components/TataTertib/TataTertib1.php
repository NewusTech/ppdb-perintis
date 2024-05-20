<?php

namespace App\Http\Livewire\Components\TataTertib;

use App\Models\TataTertib;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class TataTertib1 extends Component
{
    use WithFileUploads;

    public $tata_tertib_sekolah;

    protected $listeners = [
        'refresh_page' => '$refresh',
    ];

    public function mount()
    {
        $this->tata_tertib = TataTertib::find(1);
    }

    protected $rules = [
        'tata_tertib_sekolah' => 'required|file|mimes:pdf',
    ];

    public function updated()
    {
        $this->validate($this->rules);
    }

    public function save()
    {
        $this->validate($this->rules);

        try {
            $tata_tertib = TataTertib::find(1);

            Storage::delete([$tata_tertib->path]);
            $tata_tertib->path = $this->tata_tertib_sekolah->storeAs('files', 'TATA TERTIB SMA PERINTIS 2 BANDAR LAMPUNG.pdf', 'public');
            $tata_tertib->update();

            redirect()->to('/tata-tertib')->with('success', 'Tata tertib berhasil diubah');
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi kesalahan, silahkan coba lagi');
        }
    }

    public function cancel()
    {
        $this->tata_tertib_sekolah = null;
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.components.tata-tertib.tata-tertib1');
    }
}
