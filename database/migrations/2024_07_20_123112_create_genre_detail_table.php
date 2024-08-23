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
        Schema::create('genre_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_detail')->references('id')->on('detail')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_genre')->references('id')->on('genre')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genre_detail');
    }
};
