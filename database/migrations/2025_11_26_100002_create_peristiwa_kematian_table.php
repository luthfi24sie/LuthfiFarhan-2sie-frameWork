<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('peristiwa_kematian')) {
            return;
        }
        Schema::create('peristiwa_kematian', function (Blueprint $table) {
            $table->increments('kematian_id');
            $table->foreignId('warga_id')->constrained('warga')->cascadeOnDelete();
            $table->date('tgl_meninggal');
            $table->string('sebab', 120)->nullable();
            $table->string('lokasi', 160)->nullable();
            $table->string('no_surat', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peristiwa_kematian');
    }
};
