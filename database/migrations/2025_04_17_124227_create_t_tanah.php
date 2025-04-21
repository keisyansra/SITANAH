<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('t_tanah', function (Blueprint $table) {
            $table->id('id_tanah');
            $table->string('kode_tanah');
            $table->unsignedBigInteger('id_lokasi')->index();
            $table->string('no_kav_tanah')->unique();
            $table->float('panjang_tanah');
            $table->float('lebar_tanah');
            $table->decimal('harga', 15, 2);
            $table->timestamps();

            // mendefinisikan foreign key 
            $table->foreign('id_lokasi')->references('id_lokasi')->on('t_lokasi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_tanah');
    }
};
