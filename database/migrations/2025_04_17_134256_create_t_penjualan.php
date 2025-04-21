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
        Schema::create('t_penjualan', function (Blueprint $table) {
            $table->id('id_penjualan');
            $table->string('kode_penjualan');
            $table->unsignedBigInteger('id_nasabah')->idex();
            $table->unsignedBigInteger('id_tanah')->index();
            $table->string('pembayaran');
            $table->timestamps();

            // mendefinisikan foreign key 
            $table->foreign('id_nasabah')->references('id_nasabah')->on('t_nasabah')->onDelete('cascade');
            $table->foreign('id_tanah')->references('id_tanah')->on('t_tanah')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_penjualan');
    }
};
