<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('peristiwa_pindah')) {
            return;
        }
        Schema::create('peristiwa_pindah', function (Blueprint $table) {
            $table->increments('pindah_id');
            $table->foreignId('warga_id')->constrained('warga')->cascadeOnDelete();
            $table->date('tgl_pindah');
            $table->string('alamat_tujuan', 255);
            $table->string('alasan', 160)->nullable();
            $table->string('no_surat', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peristiwa_pindah');
    }
};
