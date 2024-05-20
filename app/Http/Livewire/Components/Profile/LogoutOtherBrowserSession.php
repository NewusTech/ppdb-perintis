<?php

namespace App\Http\Livewire\Components\Profile;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LogoutOtherBrowserSession extends Component
{
    public $session;
    public $this_device;

    protected $listeners = [
        'logoutOtherDevice' => 'mount',
    ];

    public function mount()
    {
        $this->session = DB::table('sessions')->where('user_id', '=', auth()->id())->get();
        $this->this_device = session()->getId();
    }

    public function render()
    {
        return view('livewire.components.profile.logout-other-browser-session');
    }
}
