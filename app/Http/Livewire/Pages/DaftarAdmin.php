<?php

namespace App\Http\Livewire\Pages;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;

class DaftarAdmin extends Component
{
    public $nama_lengkap, $username, $role;

    protected $listeneners = ['daftarAdmin' => '$refresh'];

    protected $rules = [
        'nama_lengkap' => 'required',
        'username' => 'required|alpha_dash|unique:users',
        'role' => 'required',
    ];

    public function updated($field)
    {
        $this->validateOnly($field, $this->rules);
    }

    public function save()
    {
        $this->validate($this->rules);
        // dd($this);
        $user = new User();
        $user->name = $this->nama_lengkap;
        $user->username = Str::lower($this->username);
        $user->password = bcrypt('password');
        $user->save();
        $user->assignRole($this->role);
        session()->flash('success', 'Admin Pendaftaran Awal berhasil ditambahkan');
        $this->emit('daftarAdminTable');
        $this->emit('daftarAdmin');
        $this->dispatchBrowserEvent('closeAddModal');
        $this->cleanForm();
    }

    public function cleanForm()
    {
        $this->reset();
        $this->resetValidation();
        $this->emit('daftarAdmin');
        $this->emit('daftarAdminTable');
    }

    public function render()
    {
        return view('livewire.pages.daftar-admin');
    }
}
