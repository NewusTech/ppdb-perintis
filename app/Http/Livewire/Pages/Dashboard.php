<?php

namespace App\Http\Livewire\Pages;

use App\Models\Pendaftaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class Dashboard extends Component
{
    public $executive;
    public $tahunSelected;
    public $tahun;

    public function mount(Request $request)
    {
        $validatedData = $request->validate([
            'tahun' => 'integer',
        ]);
        $tahunFilter = $request->tahun;

        $this->tahun = Pendaftaran::with('user', 'kelas')->orderByDesc('created_at')->get()->pluck('created_at')->map(function ($date) {
            return Carbon::parse($date)->year;
        })->unique()->values()->all();

        if (auth()->user()->roles->first()->name == 'siswa') {
            $pendaftaran = Pendaftaran::where('user_id', auth()->id())->orderBy('created_at', 'desc')->first();
            session()->flash('success', 'Selamat datang di halaman dashboard, ' . $pendaftaran->user->name);
            if ($pendaftaran->status_pengisian_formulir == null) {
                session()->flash('status', 'Silahkan isi formulir pendaftaran anda');
            } elseif ($pendaftaran->status_pengisian_formulir == 1) {
                session()->flash('status', 'Silahkan melanjutkan ke tahap wawancara');
            } elseif ($pendaftaran->lolos_wawancara == 0) {
                session()->flash('status', 'Maaf anda tidak lolos wawancara');
            } elseif ($pendaftaran->status_daftar_ulang == null) {
                session()->flash('status', 'Silahkan melanjutkan ke tahap daftar ulang');
            } elseif ($pendaftaran->status_daftar_ulang == 1) {
                session()->flash('status', 'Silahkan melanjutkan ke tahap daftar ulang');
            } elseif ($pendaftaran->lolos_wawancara == 1) {
                session()->flash('status', 'Anda belum lolos verifikasi');
            }
        } else {
            if ($tahunFilter) {
                $pendaftar = Pendaftaran::with('user', 'kelas')->whereYear('created_at', $tahunFilter)->get();
                $this->tahunSelected = $tahunFilter;
            } else {
                $pendaftar = Pendaftaran::with('user', 'kelas')->whereYear('created_at', $this->tahun[0])->get();
                $this->tahunSelected = $this->tahun[0];
            }

            $this->executive = $pendaftar->where('kelas_id', 1)->where('status_daftar_ulang', 1)->count();
            $this->reguler_ac = $pendaftar->where('kelas_id', 2)->where('status_daftar_ulang', 1)->count();
            $this->non_ac = $pendaftar->where('kelas_id', 3)->where('status_daftar_ulang', 1)->count();

            $this->executive_ipa = $pendaftar->where('kelas_id', 1)->where('status_daftar_ulang', 1)->where('jurusan', 'IPA')->count();
            $this->executive_ips = $pendaftar->where('kelas_id', 1)->where('status_daftar_ulang', 1)->where('jurusan', 'IPS')->count();
            $this->reguler_ac_ipa = $pendaftar->where('kelas_id', 2)->where('status_daftar_ulang', 1)->where('jurusan', 'IPA')->count();
            $this->reguler_ac_ips = $pendaftar->where('kelas_id', 2)->where('status_daftar_ulang', 1)->where('jurusan', 'IPS')->count();
            $this->non_ac_ipa = $pendaftar->where('kelas_id', 3)->where('status_daftar_ulang', 1)->where('jurusan', 'IPA')->count();
            $this->non_ac_ips = $pendaftar->where('kelas_id', 3)->where('status_daftar_ulang', 1)->where('jurusan', 'IPS')->count();

            // dd($pendaftar);
        }
    }

    public function refresh()
    {
        $this->mount(request()->merge(['tahun' => request('tahun')]));
    }

    public function render()
    {
        return view('livewire.pages.dashboard');
    }
}
