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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_plat')->unique();
            $table->string('merk');
            $table->string('model');
            $table->string('tipe');
            $table->year('tahun_produksi');
            $table->string('warna');
            $table->string('nomor_rangka')->unique();
            $table->string('nomor_mesin')->unique();
            $table->unsignedInteger('kapasitas_mesin')->comment('dalam CC');
            $table->string('bahan_bakar');
            $table->unsignedInteger('kapasitas_tangki')->comment('dalam Liter');
            $table->string('jenis_transmisi');
            $table->string('status_kepemilikan');
            $table->date('tanggal_registrasi');
            $table->date('tanggal_pajak')->nullable();
            $table->date('tanggal_stnk')->nullable();
            $table->text('catatan')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};