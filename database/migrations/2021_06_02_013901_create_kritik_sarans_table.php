<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKritikSaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kritik_sarans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nik')->nullable();
            $table->string('nomor_whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->enum('for', ['lurah', 'ketua_rt', 'ketua_rw'])->nullable();
            $table->boolean('confirmed')->nullable()->default(false);
            $table->longText('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kritik_sarans');
    }
}
