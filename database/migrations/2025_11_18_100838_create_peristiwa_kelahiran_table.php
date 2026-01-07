<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (!Schema::hasTable('peristiwa_kelahiran')) {
            Schema::create('peristiwa_kelahiran', function (Blueprint $table) {
                $table->id('kelahiran_id');
                $table->unsignedBigInteger('warga_id');
                $table->date('tgl_lahir');
                $table->string('tempat_lahir');
                $table->unsignedBigInteger('ayah_warga_id')->nullable();
                $table->unsignedBigInteger('ibu_warga_id')->nullable();
                $table->string('no_akta')->unique();
                $table->timestamps();

                $table->foreign('warga_id')->references('warga_id')->on('warga')->onDelete('cascade');
                $table->foreign('ayah_warga_id')->references('warga_id')->on('warga')->nullOnDelete();
                $table->foreign('ibu_warga_id')->references('warga_id')->on('warga')->nullOnDelete();
            });
        }
    }

    public function down(): void {
        Schema::dropIfExists('peristiwa_kelahiran');
    }
};
