<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiayaDaftarUlangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biaya_daftar_ulang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->constrained('kelas');
            $table->string('pilihan_pembayaran');

            $table->integer('uang_pangkal')->nullable();

            $table->integer('uang_spp')->nullable();

            $table->integer('kaos_olahraga')->nullable();
            $table->integer('bed_lokasi_dll')->nullable();
            $table->integer('baju_seragam')->nullable();
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
        Schema::dropIfExists('biaya_daftar_ulang');
    }
}
