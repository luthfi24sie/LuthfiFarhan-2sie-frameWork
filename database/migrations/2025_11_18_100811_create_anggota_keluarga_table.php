<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (!Schema::hasTable('anggota_keluarga')) {
            Schema::create('anggota_keluarga', function (Blueprint $table) {
                $table->id('anggota_id');
                $table->unsignedBigInteger('kk_id');
                $table->unsignedBigInteger('warga_id');
                $table->string('hubungan')->nullable();
                $table->timestamps();

                $table->foreign('kk_id')->references('kk_id')->on('keluarga_kk')->onDelete('cascade');
                $table->foreign('warga_id')->references('warga_id')->on('warga')->onDelete('cascade');
            });
        }
    }

    public function down(): void {
        Schema::dropIfExists('anggota_keluarga');
    }
};
