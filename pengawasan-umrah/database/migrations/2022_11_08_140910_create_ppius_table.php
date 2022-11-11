<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppius', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignId('id_user')->unique();
            $table->foreignId('id_kab_kota');
            $table->string('status');
            $table->string('nomor_sk');
            $table->date('tanggal_sk');
            $table->string('nama_pimpinan')->nullable();
            $table->text('alamat');
            $table->string('logo')->default('default.png');
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
        Schema::dropIfExists('ppius');
    }
};
