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
        Schema::create('kuitansis', function (Blueprint $table) {
            $table->id();
            $table->string('no_bukti');
            $table->date('tahun_anggaran');
            $table->string('no_MAK');
            $table->integer('biaya_penginapan');
            $table->integer('biaya_uang_harian');
            $table->integer('durasi_penginapan');
            $table->integer('durasi_uang_harian');
            $table->integer('total_biaya_penginapan');
            $table->integer('total_biaya_harian');
            $table->string('kategori');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuitansis');
    }
};
