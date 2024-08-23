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
        Schema::create('detail', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('pemeran');
            $table->date('tanggalRilis');
            $table->string('penulis');
            $table->string('sutradara');
            $table->string('perusahaanProduksi');
            $table->text('deskripsi');
            $table->string('foto');
            $table->string('harga');
            $table->foreignId('id_studio')->references('id')->on('studio')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('id_time')->references('id')->on('time')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('id_tanggal')->references('id')->on('tanggal')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail');
    }
};
