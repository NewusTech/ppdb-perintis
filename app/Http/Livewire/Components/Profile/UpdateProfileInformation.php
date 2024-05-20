<?php

namespace App\Http\Livewire\Components\Profile;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Livewire\WithFileUploads;
use Livewire\Component;

class UpdateProfileInformation extends Component
{
    use WithFileUploads;

    public $nama_lengkap;
    public $username;
    public $foto_profil;
    public $update = false;

    public function mount()
    {
        $user = auth()->user();
        $this->nama_lengkap = $user->name;
        $this->username = $user->username;
    }

    public function cleanForm()
    {
        $this->reset();
        $this->mount();
        $this->resetValidation();
    }

    public function rules()
    {
        return [
            'nama_lengkap' => 'required',
            'username' => 'required|alpha_dash|unique:users,username,' . auth()->id(),
            'foto_profil' => 'nullable|image',
        ];
    }

    public function updated($field)
    {
        $this->validateOnly($field, $this->rules());
    }

    public function saveData()
    {
        $this->validate($this->rules());

        $user = auth()->user();

        if ($this->foto_profil && $user->profile_photo_path == null) {
            $user->profile_photo_path = $this->foto_profil->store('/profile-photos');
            $user->update();
            $path_from = Storage::path($user->profile_photo_path);
            $path_destination = Storage::path('public/' . $user->profile_photo_path);
            File::move($path_from, $path_destination);
            $this->foto_profil = null;
            $this->update = true;
        } elseif ($this->foto_profil && $user->profile_photo_path != null) {
            File::delete(Storage::path('public/' . $user->profile_photo_path));
            $user->profile_photo_path = $this->foto_profil->store('/profile-photos');
            $user->update();
            $path_from = Storage::path($user->profile_photo_path);
            $path_destination = Storage::path('public/' . $user->profile_photo_path);
            File::move($path_from, $path_destination);
            $this->foto_profil = null;
            $this->update = true;
        }

        if ($user->name != $this->nama_lengkap) {
            $user->name = $this->nama_lengkap;
            $user->update();
            $this->update = true;
        }

        if ($user->username != $this->username) {
            $user->username = $this->username;
            $user->update();
            $this->update = true;
        }

        $this->emit('refreshHeader');

        if ($this->update) {
            $this->update = false;
            return session()->flash('success', 'Data berhasil diperbarui');
        } else {
            return session()->flash('info', 'Tidak ada data yang diperbaharui');
        }
    }

    public function render()
    {
        return view('livewire.components.profile.update-profile-information');
    }
}
