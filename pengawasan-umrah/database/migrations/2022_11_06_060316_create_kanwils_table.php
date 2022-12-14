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
        Schema::create('kanwils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->unique();
            $table->string('nama_pimpinan')->nullable();
            $table->text('alamat');
            $table->string('logo')->default('image-profile/sT0aKjhi1RY4jQHYfkjHgGfDNNGrr4i3wQTb5pr0.png');
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
        Schema::dropIfExists('kanwils');
    }
};
