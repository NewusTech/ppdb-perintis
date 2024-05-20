<?php

namespace App\Http\Controllers;

use App\Models\BiayaDaftarUlang;
use App\Models\Biodata;
use App\Models\Pendaftaran;
use App\Models\TataTertib;
use Barryvdh\DomPDF\Facade\Pdf;
use DateTime;
use Illuminate\Support\Facades\Storage;

class BerkasController extends Controller
{
    public function checkPermission($id)
    {
        $pendaftar = Pendaftaran::find($id);
        if($pendaftar == NULL){
            abort(404);
        }   
        $user = auth()->user();
        $role = $user->roles->first()->name;

        if ($user->id == $pendaftar->user_id  || $role == 'super admin' || $role == 'admin pendaftaran awal') {
            return true;
        } else {
            abort(404);
        }
    }

    public function cetakBuktiPendaftaranAwal($id)
    {
        $pendaftar = Pendaftaran::with('user', 'kelas')->find($id);

        if ($pendaftar->status_pengisian_formulir === null) {
            abort(404);
        }

        $biaya_daftar_ulang = BiayaDaftarUlang::where('kelas_id', $pendaftar->kelas_id)->first();

        $pendaftar->tanggal_lahir = new DateTime($pendaftar->tanggal_lahir);

        $path = 'berkas/' . $pendaftar->id;
        $pdf = Pdf::loadView('pdf.bukti-pendaftaran-awal-dan-informasi-daftar-ulang', compact('pendaftar', 'biaya_daftar_ulang'));

        // return $pdf->stream();
        Storage::put($path . '/Formulir Pendaftaran ' . $pendaftar->user->name . '.pdf', $pdf->output());

        $pendaftar->formulir_pendaftaran = $path . '/Formulir Pendaftaran ' . $pendaftar->user->name . '.pdf';
        $pendaftar->update();
        return redirect('/formulir-pendaftaran/' . $id)->with('success', 'Berhasil membuat bukti pendaftaran awal dan informasi daftar ulang');
    }

    public function unduhBuktiPendaftaranAwal($id)
    {
        $pendaftar = Pendaftaran::find($id);

        if ($pendaftar->formulir_pendaftaran === null) {
            abort(404);
        } elseif ($this->checkPermission($id)) {
            $path = storage_path('app/' . $pendaftar->formulir_pendaftaran);
            return response()->file($path);
        }
    }

    public function downloadTataTertibSekolah()
    {
        $tata_tertib = TataTertib::find(1);
        $path = public_path('storage/' . $tata_tertib->path);
        return response()->file($path);
    }

    public function cetakSuratPernyataanSiswaBaru($id)
    {
        $pendaftar = Pendaftaran::with('user', 'kelas')->find($id);
        $tata_tertib = TataTertib::find(2)->desc;

        $pendaftar->tanggal_lahir = new DateTime($pendaftar->tanggal_lahir);

        $path = 'berkas/' . $pendaftar->id;
        $pdf = Pdf::loadView('pdf.surat-pernyataan-siswa-baru', compact('pendaftar', 'tata_tertib'));
        // dd($pdf->stream());
        // return $pdf->stream();
        Storage::put($path . '/Surat Pernyataan Siswa Baru ' . $pendaftar->user->name . '.pdf', $pdf->output());

        $pendaftar->pernyataan_siswa_baru = $path . '/Surat Pernyataan Siswa Baru ' . $pendaftar->user->name . '.pdf';
        $pendaftar->update();
        return redirect()->back()->with('success', 'Berhasil membuat surat pernyataan siswa baru');
    }

    public function downloadSuratPernyataanSiswaBaru($id)
    {
        $pendaftar = Pendaftaran::find($id);

        if ($pendaftar->pernyataan_siswa_baru == null) {
            abort(404);
        } elseif ($this->checkPermission($id)) {
            $path = storage_path('app/' . $pendaftar->pernyataan_siswa_baru);
            return response()->file($path);
        }
    }


    public function cetakLembarPerjanjian($id)
    {
        $pendaftar = Pendaftaran::with('user', 'kelas')->find($id);
        $tata_tertib = TataTertib::find(2)->desc;

        $path = 'berkas/' . $pendaftar->id;
        $pdf = Pdf::loadView('pdf.lembar-perjanjian', compact('pendaftar', 'tata_tertib'));

        // return $pdf->stream();
        Storage::put($path . '/Lembar Perjanjian ' . $pendaftar->user->name . '.pdf', $pdf->output());

        $pendaftar->lembar_perjanjian = $path . '/Lembar Perjanjian ' . $pendaftar->user->name . '.pdf';
        $pendaftar->update();
        return redirect()->back()->with('success', 'Berhasil membuat lembar perjanjian');
    }

    public function downloadLembarPerjanjian($id)
    {
        $pendaftar = Pendaftaran::find($id);

        if ($pendaftar->lembar_perjanjian == null) {
            abort(404);
        } elseif ($this->checkPermission($id)) {
            $path = storage_path('app/' . $pendaftar->lembar_perjanjian);
            return response()->file($path);
        }
    }

    public function cetakKwitansi($id)
    {
        $pendaftar = Pendaftaran::with('user', 'kelas')->find($id);
        $biaya_lunas = BiayaDaftarUlang::where('kelas_id', $pendaftar->kelas_id)->first();
        $biaya_angsuran = BiayaDaftarUlang::where('kelas_id', $pendaftar->kelas_id)->orderBy('id', 'desc')->first();
        $pendaftar->tanggal_lahir = new DateTime($pendaftar->tanggal_lahir);

        $path = 'berkas/' . $pendaftar->id;

        if ($pendaftar->lunas === null) {
            $pdf_lunas = Pdf::loadView('pdf.kwitansi-lunas', compact('pendaftar', 'biaya_lunas'))->setPaper(array(0, 0, 612, 468));
            $pdf_angsuran = Pdf::loadView('pdf.kwitansi-angsuran', compact('pendaftar', 'biaya_angsuran'))->setPaper(array(0, 0, 612, 468));
            // return $pdf->stream();
            Storage::put($path . '/Kwitansi Lunas ' . $pendaftar->user->name . '.pdf', $pdf_lunas->output());
            Storage::put($path . '/Kwitansi Angsuran ' . $pendaftar->user->name . '.pdf', $pdf_angsuran->output());
            $pendaftar->kwitansi_lunas = $path . '/Kwitansi Lunas ' . $pendaftar->user->name . '.pdf';
            $pendaftar->kwitansi_angsuran = $path . '/Kwitansi Angsuran ' . $pendaftar->user->name . '.pdf';
        } else {
            $pdf_lunas = Pdf::loadView('pdf.kwitansi-lunas', compact('pendaftar', 'biaya_lunas'))->setPaper(array(0, 0, 612, 468));
            Storage::put($path . '/Kwitansi Lunas ' . $pendaftar->user->name . '.pdf', $pdf_lunas->output());
            $pendaftar->kwitansi_lunas = $path . '/Kwitansi Lunas ' . $pendaftar->user->name . '.pdf';
        }

        $pendaftar->update();
        return redirect()->back()->with('success', 'Berhasil membuat kwitansi');
    }


    public function downloadKwitansiLunas($id)
    {
        $pendaftar = Pendaftaran::find($id);

        if ($pendaftar->kwitansi_lunas == null) {
            abort(404);
        } elseif ($this->checkPermission($id)) {
            $path = storage_path('app/' . $pendaftar->kwitansi_lunas);
            return response()->file($path);
        }
    }

    public function downloadKwitansiAngsuran($id)
    {
        $pendaftar = Pendaftaran::find($id);

        if ($pendaftar->kwitansi_angsuran == null) {
            abort(404);
        } elseif ($this->checkPermission($id)) {
            $path = storage_path('app/' . $pendaftar->kwitansi_angsuran);
            return response()->file($path);
        }
    }

    public function cetakBiodataSiswa($id)
    {
        $pendaftar = Pendaftaran::with('user', 'kelas')->find($id);

        $path = 'berkas/' . $pendaftar->id;
        $pendaftar->tanggal_lahir = new DateTime($pendaftar->tanggal_lahir);
        $pendaftar->tanggal_lahir_ayah = new DateTime($pendaftar->tanggal_lahir_ayah);
        $pendaftar->tanggal_lahir_ibu = new DateTime($pendaftar->tanggal_lahir_ibu);
        $pendaftar->tanggal_lahir_wali = new DateTime($pendaftar->tanggal_lahir_wali);

        $pdf = Pdf::loadView('pdf.biodata', compact('pendaftar'));

        // return $pdf->stream();
        Storage::put($path . '/Biodata ' . $pendaftar->user->name . '.pdf', $pdf->output());

        $pendaftar->biodata = $path . '/Biodata ' . $pendaftar->user->name . '.pdf';
        $pendaftar->update();
        return redirect()->back()->with('success', 'Berhasil membuat Biodata');
    }

    public function downloadBiodataSiswa($id)
    {
        $pendaftar = Pendaftaran::find($id);

        if ($pendaftar->biodata == null) {
            abort(404);
        } elseif ($this->checkPermission($id)) {
            $path = storage_path('app/' . $pendaftar->biodata);
            return response()->file($path);
        }
    }

    public function downloadKwitansi($id, $idBerkas)
    {
        $pendaftar = Pendaftaran::find($id);
        if ($this->checkPermission($id)) {
            $biayaJSON = json_decode($pendaftar->biaya_daftar_ulang_id, TRUE);
            $idbiayaJSON = array_search($idBerkas, array_column($biayaJSON, 'id'));
            $path = storage_path('app/' . $biayaJSON[$idbiayaJSON]['kwitansi']);
            return response()->file($path);
        } else {
            abort(404);
        }
    }
}
