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
        Schema::create('order_kursi', function (Blueprint $table) {
            $table->id();
            $table->enum('status',['Notorder','order'])->default('Notorder');
            $table->foreignId('id_kursi')->references('id')->on('kursi')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_order')->references('id')->on('order')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_kursi');
    }
};
