<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('keluarga_kk', function (Blueprint $table) {
            $table->id('kk_id');
            $table->string('kk_nomor')->unique();
            $table->unsignedBigInteger('kepala_keluarga_warga_id')->nullable();
            $table->string('alamat')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->timestamps();

            $table->foreign('kepala_keluarga_warga_id')->references('warga_id')->on('warga')->nullOnDelete();
        });
    }

    public function down(): void {
        Schema::dropIfExists('keluarga_kk');
    }
};
