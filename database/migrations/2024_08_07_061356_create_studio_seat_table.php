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
        Schema::create('studio_seat', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('studio_id')->references('id')->on('studio')->onDelete('cascade');
            $table->foreignId('kursi_id')->references('id')->on('kursi')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studio_seat');
    }
};
