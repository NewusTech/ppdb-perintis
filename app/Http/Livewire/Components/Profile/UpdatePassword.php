<?php

namespace App\Http\Livewire\Components\Profile;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UpdatePassword extends Component
{
    public $password_saat_ini;
    public $password_baru;
    public $konfirmasi_password_baru;

    protected $rules = [
        'password_saat_ini' => 'required',
        'password_baru' => 'required|min:8',
        'konfirmasi_password_baru' => 'required|same:password_baru',
    ];

    public function cleanForm()
    {
        $this->reset();
        $this->resetValidation();
    }

    public function updated($field)
    {
        $this->validateOnly($field, $this->rules);
    }

    public function saveData()
    {
        $this->validate($this->rules);

        $user = auth()->user();
        if (!Hash::check($this->password_saat_ini, $user->password)) {
            return session()->flash('error', 'Password saat ini tidak sesuai');
        }

        $user->password = Hash::make($this->password_baru);
        $user->update();

        $this->cleanForm();

        return session()->flash('success', 'Password berhasil diperbarui dan anda harus login kembali');
    }

    public function render()
    {
        return view('livewire.components.profile.update-password');
    }
}
