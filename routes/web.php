<?php

use App\Http\Controllers\BerkasController;
use App\Http\Livewire\Pages\Biodata;
use App\Http\Livewire\Pages\DaftarAdmin;
use App\Http\Livewire\Pages\DaftarSiswa;
use App\Http\Livewire\Pages\DaftarUlang;
use App\Http\Livewire\Pages\Dashboard;
use App\Http\Livewire\Pages\FormulirBiodata;
use App\Http\Livewire\Pages\FormulirDaftarUlang;
use App\Http\Livewire\Pages\FormulirPendaftaran;
use App\Http\Livewire\Pages\FormulirWawancara;
use App\Http\Livewire\Pages\IsiFormulirPendaftaran;
use App\Http\Livewire\Pages\Laporan;
use App\Http\Livewire\Pages\PendaftaranAwal;
use App\Http\Livewire\Pages\Profile;
use App\Http\Livewire\Pages\SettingBiaya;
use App\Http\Livewire\Pages\TataTertib;
use App\Http\Livewire\Pages\Wawancara;
use Illuminate\Support\Facades\Route;


// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', Dashboard::class)->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::redirect('/register', '/dashboard');
    Route::redirect('/forgot-password', '/dashboard');
    Route::redirect('/email/verify', '/dashboard');
    Route::redirect('/', '/dashboard');
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    // route pendaftaran awal
    Route::group(['middleware' => 'role:admin pendaftaran awal|admin wawancara|admin daftar ulang|admin verifikasi|super admin'], function () {
        Route::get('/pendaftaran-awal', PendaftaranAwal::class);
        Route::get('/cetak-bukti-pendaftaran-awal-dan-informasi-daftar-ulang/{id}', BerkasController::class . '@cetakBuktiPendaftaranAwal');
    });

    // route formulir pendaftaran awal
    // Route::group(['middleware' => 'role:siswa|admin pendaftaran awal|admin wawancara|admin daftar ulang|admin verifikasi|super admin'], function () {
    Route::get('/formulir-pendaftaran', FormulirPendaftaran::class);
    Route::get('/formulir-pendaftaran/{id}', IsiFormulirPendaftaran::class);
    Route::get('/unduh-bukti-pendaftaran-awal/{id}', BerkasController::class . '@unduhBuktiPendaftaranAwal');
    // });

    // route wawancara
    Route::group(['middleware' => 'role:siswa|admin wawancara|admin daftar ulang|admin verifikasi|super admin'], function () {
        Route::get('/wawancara', Wawancara::class);
        Route::get('/wawancara/{id}', FormulirWawancara::class);
        Route::get('/cetak-surat-pernyataan-siswa-baru/{id}', BerkasController::class . '@cetakSuratPernyataanSiswaBaru');
        Route::get('/download-surat-pernyataan-siswa-baru/{id}', BerkasController::class . '@downloadSuratPernyataanSiswaBaru');
    });

    // route daftar ulang
    Route::group(['middleware' => 'role:siswa|admin daftar ulang|admin verifikasi|super admin'], function () {
        Route::get('/daftar-ulang', DaftarUlang::class);
        Route::get('/daftar-ulang/{id}', FormulirDaftarUlang::class);
        Route::get('/cetak-lembar-perjanjian/{id}', BerkasController::class . '@cetakLembarPerjanjian');
        Route::get('/download-lembar-perjanjian/{id}', BerkasController::class . '@downloadLembarPerjanjian');
        Route::get('/cetak-kwitansi/{id}', BerkasController::class . '@cetakKwitansi');
        Route::get('/download-kwitansi-lunas/{id}', BerkasController::class . '@downloadKwitansiLunas');
        Route::get('/download-kwitansi/{id}/{idBerkas}', BerkasController::class . '@downloadKwitansi');
        Route::get('/download-kwitansi-angsuran/{id}', BerkasController::class . '@downloadKwitansiAngsuran');
    });

    // route biodata
    Route::group(['middleware' => 'role:siswa|admin verifikasi|super admin'], function () {
        Route::get('/biodata', Biodata::class);
        Route::get('/biodata/{id}', FormulirBiodata::class);
        Route::get('/cetak-biodata-siswa/{id}', BerkasController::class . '@cetakBiodataSiswa');
        Route::get('/download-biodata-siswa/{id}', BerkasController::class . '@downloadBiodataSiswa');
    });

    // route download tata tertib dan surat pernyataan
    Route::get('/download-tata-tertib-sekolah', BerkasController::class . '@downloadTataTertibSekolah');

    // route laporan
    Route::group(['middleware' => 'role:pimpinan|super admin'], function () {
        Route::get('/laporan', Laporan::class);
        // Route::post('/export', ExportController::class . '@export');
    });

    // route daftar siswa dan admin
    Route::group(['middleware' => 'role:super admin'], function () {
        Route::get('/daftar-siswa', DaftarSiswa::class);
        Route::get('/daftar-admin', DaftarAdmin::class);
    });

    // route profile
    Route::get('/profile', Profile::class);

    // route setting biaya
    Route::get('/setting-biaya', SettingBiaya::class);

    // route tata tertib
    Route::get('/tata-tertib', TataTertib::class);
});
