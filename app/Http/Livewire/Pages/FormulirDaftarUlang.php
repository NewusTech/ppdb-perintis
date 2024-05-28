<?php

namespace App\Http\Livewire\Pages;

use App\Models\BiayaDaftarUlang;
use App\Models\Kelas;
use App\Models\Pendaftaran;
use Barryvdh\DomPDF\Facade\Pdf;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class FormulirDaftarUlang extends Component
{
    protected $listeners = [
        'tabelPembayaran' => '$refresh', 'modalClosed'
    ];

    public $pembayaran_daftar_ulang;
    public $biaya_daftar_ulang_id;
    public $uang_pangkal_edit;
    public $uang_spp_edit;
    public $kaos_olahraga_edit;
    public $bed_lokasi_dll_edit;
    public $baju_seragam_edit;
    public $biaya_pendaftaran;

    protected $rules = [
        'pembayaran_daftar_ulang'   => 'required',
        'uang_pangkal'              => 'required|numeric',
        'uang_spp'                  => 'required|numeric',
        'kaos_olahraga'             => 'required|numeric',
        'bed_lokasi_dll'            => 'required|numeric',
        'baju_seragam'              => 'required|numeric',
    ];

    protected $messages = [
        '*.required' => 'Wajib diisi',
        '*.numeric' => 'Inputan wajib berupa angka',
    ];

    public function modalClosed()
    {
        $this->emit('closeModal');
    }

    public function cleanForm()
    {
        $this->resetValidation();
    }

    public function mount($id)
    {
        $pendaftar = Pendaftaran::with('user', 'kelas')->find($id);
        if ($pendaftar === null || $pendaftar->status_wawancara === null) {
            abort(404);
        }

        $this->pendaftar = $pendaftar;
        $this->nama_lengkap = $pendaftar->user->name;
        $this->nisn = $pendaftar->user->username;
        $this->kelas = $pendaftar->kelas_id;
        if ($pendaftar->lunas === 1) {
            $this->pembayaran_daftar_ulang = 'Lunas';
        } elseif ($pendaftar->angsuran === 1) {
            $this->pembayaran_daftar_ulang = 'Angsuran';
        }
        if ($pendaftar->biaya_daftar_ulang_id != NULL) {
            $this->biaya_daftar_ulang_id = json_decode($pendaftar->biaya_daftar_ulang_id, true);
            foreach ($this->biaya_daftar_ulang_id as $key => $item) {
                $this->uang_pangkal_edit = isset($item['uang_pangkal']) ? $item['uang_pangkal'] : null;
                $this->uang_spp_edit = isset($item['uang_spp']) ? $item['uang_spp'] : null;
                $this->kaos_olahraga_edit = isset($item['kaos_olahraga']) ? $item['kaos_olahraga'] : null;
                $this->bed_lokasi_dll_edit = isset($item['bed_lokasi_dll']) ? $item['bed_lokasi_dll'] : null;
                $this->baju_seragam_edit = isset($item['baju_seragam']) ? $item['baju_seragam'] : null;
            }
        } else {
            $this->biaya_daftar_ulang_id = [];
        }

        $this->uang_pangkal = NULL;
        $this->uang_spp = NULL;

        $this->kaos_olahraga = NULL;
        $this->bed_lokasi_dll = NULL;
        $this->baju_seragam = NULL;

        $kelas = Kelas::where('id', $this->kelas)->first();
        if ($kelas != NULL) {
            $this->biaya_pendaftaran = $kelas->biaya_pendaftaran;
        } else {
            $this->biaya_pendaftaran = '';
        }
    }

    public function updated($field)
    {
        $this->validateOnly($field, $this->rules);
    }
    
    public function updateKwitansi($id)
    {
        try {
            $pendaftar = Pendaftaran::with('user', 'kelas')->find($id);
            $biayaJSON = $pendaftar->biaya_daftar_ulang_id;
            $decodeParamsDef = json_decode($biayaJSON);
            $params = [
                'id' => $decodeParamsDef[0]->id,
                'kaos_olahraga' => $this->kaos_olahraga_edit,
                'bed_lokasi_dll' => $this->bed_lokasi_dll_edit,
                'baju_seragam' => $this->baju_seragam_edit,
                'uang_pangkal' => $this->uang_pangkal_edit,
                'uang_spp' => $this->uang_spp_edit,

                "kelas_id" => $decodeParamsDef[0]->kelas_id,
                "pilihan_pembayaran" => $decodeParamsDef[0]->pilihan_pembayaran,
                "date" => $decodeParamsDef[0]->date,
                "kwitansi" => $decodeParamsDef[0]->kwitansi
            ];

            $path = 'berkas/' . $pendaftar->id;

            if ($params['pilihan_pembayaran'] == 'Angsuran') {
                $pdf_angsuran = Pdf::loadView('pdf.kwitansi-angsuran', compact('pendaftar', 'params'))->setPaper(array(0, 0, 612, 468));
                Storage::delete($path . '/Kwitansi Angsuran ' . $pendaftar->user->name . '-' . $params['id'] . '.pdf');
                Storage::put($path . '/Kwitansi Angsuran ' . $pendaftar->user->name . '-' . $params['id'] . '.pdf', $pdf_angsuran->output());
                $params['kwitansi'] = $path . '/Kwitansi Angsuran ' . $pendaftar->user->name . '-' . $params['id'] . '.pdf';
            } else {
                $pdf_lunas = Pdf::loadView('pdf.kwitansi-lunas', compact('pendaftar', 'params'))->setPaper(array(0, 0, 612, 468));
                Storage::delete($path . '/Kwitansi Lunas ' . $pendaftar->user->name . '-' . $params['id'] . '.pdf');
                Storage::put($path . '/Kwitansi Lunas ' . $pendaftar->user->name . '-' . $params['id'] . '.pdf', $pdf_lunas->output());
                $params['kwitansi'] = $path . '/Kwitansi Lunas ' . $pendaftar->user->name . '-' . $params['id'] . '.pdf';
            }

            if ($biayaJSON) {
                $temp[] = $params;
                $pendaftar->biaya_daftar_ulang_id = json_encode($temp, TRUE);
                $pendaftar->update();
            }
           
            $updateParams = [
                'kaos_olahraga' => $this->kaos_olahraga_edit,
                'bed_lokasi_dll' => $this->bed_lokasi_dll_edit,
                'baju_seragam' => $this->baju_seragam_edit,
                'uang_pangkal' => $this->uang_pangkal_edit,
                'uang_spp' => $this->uang_spp_edit
            ];

            $whereId = $this->biaya_daftar_ulang_id[0]['id'];
            $updateBiaya = BiayaDaftarUlang::where('id', $whereId)->update($updateParams);

            //update biaya pendaftaran
            $kelas = Kelas::where('id', $pendaftar->kelas_id)->first();
            $kelas->biaya_pendaftaran = $this->biaya_pendaftaran;
            $kelas->update();
            session()->flash('success', 'Berhasil menyimpan data');
            $this->emitSelf('modalClosed');
        } catch (\Exception $th) {
            session()->flash('error', 'Gagal menyimpan data');
        }
    }   

    public function save($id)
    {
        $this->validate($this->rules);
        try {
            $pendaftar = Pendaftaran::with('user', 'kelas')->find($id);

            if ($this->pembayaran_daftar_ulang == 'Lunas') {
                $pendaftar->angsuran = 0;
                $pendaftar->lunas = 1;
            } elseif ($this->pembayaran_daftar_ulang == 'Angsuran') {
                $pendaftar->angsuran = 1;
                $pendaftar->lunas = null;
            }
            $pendaftar->status_daftar_ulang = true;

            $biaya = BiayaDaftarUlang::where('pilihan_pembayaran', $this->pembayaran_daftar_ulang)->where('kelas_id', $this->kelas)->orderBy('created_at', 'DESC')->first();

            if ($biaya != NULL) {
                if ($biaya->kaos_olahraga != $this->kaos_olahraga || $biaya->bed_lokasi_dll != $this->bed_lokasi_dll || $biaya->baju_seragam != $this->baju_seragam || $biaya->uang_pangkal != $this->uang_pangkal || $biaya->uang_spp != $this->uang_spp) {
                    //add
                    $biayaDaftarUlang = new BiayaDaftarUlang();
                    $biayaDaftarUlang->kaos_olahraga = $this->kaos_olahraga;
                    $biayaDaftarUlang->bed_lokasi_dll = $this->bed_lokasi_dll;
                    $biayaDaftarUlang->baju_seragam = $this->baju_seragam;
                    $biayaDaftarUlang->uang_pangkal = $this->uang_pangkal;
                    $biayaDaftarUlang->uang_spp = $this->uang_spp;
                    $biayaDaftarUlang->kelas_id = $this->kelas;
                    $biayaDaftarUlang->pilihan_pembayaran = $this->pembayaran_daftar_ulang;
                    $biayaDaftarUlang->save();
                    $biayaDaftarUlangID = $biayaDaftarUlang->id;
                } else {
                    //ambil id masukan ke biaya_daftar_ulang_id
                    $biayaDaftarUlangID = $biaya->id;
                }
            } else {
                //add
                $biayaDaftarUlang = new BiayaDaftarUlang();
                $biayaDaftarUlang->kaos_olahraga = $this->kaos_olahraga;
                $biayaDaftarUlang->bed_lokasi_dll = $this->bed_lokasi_dll;
                $biayaDaftarUlang->baju_seragam = $this->baju_seragam;
                $biayaDaftarUlang->uang_pangkal = $this->uang_pangkal;
                $biayaDaftarUlang->uang_spp = $this->uang_spp;
                $biayaDaftarUlang->kelas_id = $this->kelas;
                $biayaDaftarUlang->pilihan_pembayaran = $this->pembayaran_daftar_ulang;
                $biayaDaftarUlang->save();
                $biayaDaftarUlangID = $biayaDaftarUlang->id;
            }

            $params = [
                'id' => $biayaDaftarUlangID,
                'kaos_olahraga' => $this->kaos_olahraga,
                'bed_lokasi_dll' => $this->bed_lokasi_dll,
                'baju_seragam' => $this->baju_seragam,
                'uang_pangkal' => $this->uang_pangkal,
                'uang_spp' => $this->uang_spp,
                'kelas_id' => $this->kelas,
                'pilihan_pembayaran' => $this->pembayaran_daftar_ulang,
                'date' => date('d-m-Y')
            ];


            $pendaftar->kelas_id = $this->kelas;
            $pendaftar->update();


            $pendaftar = Pendaftaran::with('user', 'kelas')->find($id);
            $pendaftar->tanggal_lahir = new DateTime($pendaftar->tanggal_lahir);

            $path = 'berkas/' . $pendaftar->id;

            if ($params['pilihan_pembayaran'] == 'Angsuran') {
                $pdf_angsuran = Pdf::loadView('pdf.kwitansi-angsuran', compact('pendaftar', 'params'))->setPaper(array(0, 0, 612, 468));
                Storage::put($path . '/Kwitansi Angsuran ' . $pendaftar->user->name . '-' . $params['id'] . '.pdf', $pdf_angsuran->output());
                $params['kwitansi'] = $path . '/Kwitansi Angsuran ' . $pendaftar->user->name . '-' . $params['id'] . '.pdf';
            } else {
                $pdf_lunas = Pdf::loadView('pdf.kwitansi-lunas', compact('pendaftar', 'params'))->setPaper(array(0, 0, 612, 468));
                Storage::put($path . '/Kwitansi Lunas ' . $pendaftar->user->name . '-' . $params['id'] . '.pdf', $pdf_lunas->output());
                $params['kwitansi'] = $path . '/Kwitansi Lunas ' . $pendaftar->user->name . '-' . $params['id'] . '.pdf';
            }

            $biayaJSON = $pendaftar->biaya_daftar_ulang_id;
            if ($biayaJSON == NULL) {
                $temp[] = $params;
                $pendaftar->biaya_daftar_ulang_id = json_encode($temp, TRUE);
                $this->biaya_daftar_ulang_id = $temp;
            } else {
                $temp = json_decode($biayaJSON, true);
                $temp[] = $params;
                $pendaftar->biaya_daftar_ulang_id = json_encode($temp, TRUE);
                $this->biaya_daftar_ulang_id = $temp;
            }

            $pendaftar->update();


            session()->flash('success_biaya', 'Berhasil menyimpan data');
        } catch (\Exception $e) {
            session()->flash('error_biaya', 'Gagal menyimpan data');
        }
    }

    public function render()
    {
        return view('livewire.pages.formulir-daftar-ulang');
    }

    public function changeEvent($value)
    {
        $biaya = BiayaDaftarUlang::where('pilihan_pembayaran', $value)->where('kelas_id', $this->kelas)->orderBy('created_at', 'DESC')->first();
        $kelas = Kelas::where('id', $this->kelas)->first();
        if ($kelas != NULL) {
            $this->biaya_pendaftaran = $kelas->biaya_pendaftaran;
        } else {
            $this->biaya_pendaftaran = '';
        }
        if ($biaya != NULL) {
            $this->uang_pangkal = $biaya->uang_pangkal;
            $this->uang_spp = $biaya->uang_spp;

            $this->kaos_olahraga = $biaya->kaos_olahraga;
            $this->bed_lokasi_dll = $biaya->bed_lokasi_dll;
            $this->baju_seragam = $biaya->baju_seragam;
        } else {
            $this->uang_pangkal = '';
            $this->uang_spp = '';

            $this->kaos_olahraga = '';
            $this->bed_lokasi_dll = '';
            $this->baju_seragam = '';
        }
    }

}
