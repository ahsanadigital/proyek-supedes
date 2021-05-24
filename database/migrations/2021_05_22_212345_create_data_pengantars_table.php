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
            $table->string('nama_terang');
            $table->string('keperluan');
            $table->text('description')->nullable();
            $table->boolean('status')->default(false);
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
