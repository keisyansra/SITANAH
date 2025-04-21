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
        Schema::create('t_nasabah', function (Blueprint $table) {
            $table->id('id_nasabah');
            $table->string('kode_nasabah');
            $table->string('nama_nasabah');
            $table->string('alamat_nasabah');
            $table->string('telp_nasabah');
            $table->string('nama_kerabat_nasabah');
            $table->string('telp_kerabat_nasabah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_nasabah');
    }
};
