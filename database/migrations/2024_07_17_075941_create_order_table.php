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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->string('total_harga');
            $table->string('jumlah_tiket');
            $table->string('pembayaran')->nullable();
            $table->enum('status',['pending','paid','cancel'])->default('pending');
            $table->foreignId('id_detail')->references('id')->on('detail')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('kembalian')->default(0);
            $table->timestamps();
            $table->softDeletes();

        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
