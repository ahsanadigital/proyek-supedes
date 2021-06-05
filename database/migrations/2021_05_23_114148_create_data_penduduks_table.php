<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPenduduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_penduduks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama_lengkap', 255)->nullable();
            $table->string('nomor_nik', 17)->nullable();
            $table->enum('jenis_kelamin', ['l', 'p', 'o'])->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tgl_lahir')->nullable()->default(null);
            $table->enum('kewarganegaraan', ['wni', 'wna'])->nullable();
            $table->enum('agama', ['islam', 'katolik', 'protestan', 'hindu', 'buddha', 'konghuchu', 'lainnya'])->nullable();
            $table->enum('pend_terakhir', ['sd', 'smp', 'sma', 'sarjana', 'diploma'])->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('alamat_jalan')->nullable();
            $table->integer('RT')->unsigned()->nullable();
            $table->integer('RW')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_penduduks');
    }
}
