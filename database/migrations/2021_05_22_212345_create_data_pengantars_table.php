<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPengantarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_pengantars', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('id_surat');
            $table->string('nik');
            $table->string('keperluan');
            $table->text('description')->nullable();
            $table->boolean('status')->default(false);
            $table->enum('keterangan', ['verifikasi_rw', 'verifikasi_rt', 'verifikasi_lurah', 'terverifikasi'])->nullable();
            $table->date('tgl_berlaku')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_pengantars');
    }
}
