<?php

namespace App\Http\Livewire\Components\Profile;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class FormLogoutOtherBrowserSession extends Component
{
    public $password_saat_ini;

    public function cleanForm()
    {
        $this->password_saat_ini = null;
        $this->resetValidation();
    }

    protected $rules = [
        'password_saat_ini' => 'required',
    ];

    public function updated($field)
    {
        $this->validateOnly($field, $this->rules);
    }

    public function logoutOtherDevice()
    {
        $this->validate($this->rules);
        $user = auth()->user();
        if (!Hash::check($this->password_saat_ini, $user->password)) {
            return session()->flash('error', 'Password saat ini tidak sesuai');
        }

        $this->session = DB::table('sessions')->where('user_id', '=', auth()->id())->get();
        $this->this_device = session()->getId();
        foreach ($this->session as $session) {
            if ($session->id != $this->this_device) {
                DB::table('sessions')->where('id', '=', $session->id)->delete();
            }
        }
        $this->cleanForm();
        $this->emit('logoutOtherDevice');
        return session()->flash('success', 'Keluar dari perangkat lain berhasil');
    }

    public function render()
    {
        return view('livewire.components.profile.form-logout-other-browser-session');
    }
}
