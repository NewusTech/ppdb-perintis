<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->integer('no_pendaftaran');
            $table->foreignId('kelas_id')->constrained('kelas');

            $table->string('jurusan')->nullable();
            $table->string('catatan')->nullable();

            // keterangan pribadi
            $table->string('nama_panggilan')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('agama')->nullable();
            $table->bigInteger('nik')->nullable();
            $table->string('kewarganegaraan')->nullable();
            $table->string('anak_ke')->nullable();
            $table->string('dari_bersaudara')->nullable();
            $table->string('status_dalam_keluarga')->nullable();
            $table->string('jumlah_saudara_kandung')->nullable();

            $table->string('bahasa_sehari_hari')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->string('alamat_asal_sekolah')->nullable();
            $table->integer('no_ijazah')->nullable();
            $table->integer('tahun_ijazah')->nullable();
            $table->integer('no_skhu')->nullable();
            $table->integer('tahun_skhu')->nullable();

            // keterangan tempat tinggal
            $table->string('no_hp_siswa')->nullable();
            $table->string('alamat_lengkap')->nullable();
            $table->string('alamat_tersebut')->nullable();

            // keterangan kesehatan
            $table->string('golongan_darah')->nullable();
            $table->string('penyakit_yang_pernah_diderita')->nullable();
            $table->string('kelainan_jasmani')->nullable();
            $table->string('tinggi_berat_badan')->nullable();

            // keterangan orang tua
            $table->string('nama_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('tempat_lahir_ayah')->nullable();
            $table->date('tanggal_lahir_ayah')->nullable();
            $table->string('penghasilan_ayah')->nullable();

            $table->string('nama_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('tempat_lahir_ibu')->nullable();
            $table->date('tanggal_lahir_ibu')->nullable();
            $table->string('penghasilan_ibu')->nullable();

            $table->string('alamat_orang_tua')->nullable();
            $table->string('no_hp_orang_tua')->nullable();

            // keterangan wali
            $table->string('nama_wali')->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->string('tempat_lahir_wali')->nullable();
            $table->date('tanggal_lahir_wali')->nullable();
            $table->string('alamat_wali')->nullable();
            $table->string('no_hp_wali')->nullable();
            $table->string('agama_wali')->nullable();
            $table->string('status_hubungan_wali')->nullable();
            $table->string('penghasilan_wali')->nullable();

            // keterangan kegemaran / hobi
            $table->string('kesenian')->nullable();
            $table->string('olahraga')->nullable();
            $table->string('organisasi')->nullable();
            $table->string('lain_lain')->nullable();

            // status dan keterangan
            $table->tinyInteger('angsuran')->nullable();
            $table->tinyInteger('lunas')->nullable();
            $table->tinyInteger('status_pengisian_formulir')->nullable();
            $table->tinyInteger('status_wawancara')->nullable();
            $table->tinyInteger('status_daftar_ulang')->nullable();
            $table->tinyInteger('status_pengisian_biodata')->nullable();
            $table->tinyInteger('status_verifikasi')->nullable();
            $table->tinyInteger('lolos_verifikasi')->nullable();

            // file
            $table->mediumText('foto')->nullable();
            $table->mediumText('formulir_pendaftaran')->nullable();
            $table->mediumText('pernyataan_siswa_baru')->nullable();
            $table->mediumText('lembar_perjanjian')->nullable();
            $table->mediumText('kwitansi_angsuran')->nullable();
            $table->mediumText('kwitansi_lunas')->nullable();
            $table->mediumText('biodata')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendaftaran');
    }
}
