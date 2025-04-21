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
        Schema::create('t_lokasi', function (Blueprint $table) {
            $table->id('id_lokasi');
            $table->string('kode_lokasi');
            $table->string('alamat_lokasi', 255);
            $table->string('kelurahan_lokasi', 100);
            $table->string('kecamatn_lokasi', 100);
            $table->string('kota_kab_lokasi', 100);
            $table->string('provinsi_lokasi', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_lokasi');
    }
};
