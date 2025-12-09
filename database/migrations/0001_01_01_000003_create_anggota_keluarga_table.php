<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anggota_keluarga', function (Blueprint $table) {
            $table->id('anggota_id');
            $table->unsignedBigInteger('kk_id');
            $table->unsignedBigInteger('warga_id');
            $table->string('hubungan', 50);
            $table->timestamps();

            // Indexes for better performance
            $table->index('kk_id');
            $table->index('warga_id');
            $table->index('hubungan');

            // Foreign key constraints (akan aktif setelah tabel terkait dibuat)
            // $table->foreign('kk_id')->references('kk_id')->on('keluarga_kk')->onDelete('cascade');
            // $table->foreign('warga_id')->references('warga_id')->on('warga')->onDelete('cascade');

            // Unique constraint untuk mencegah duplikasi anggota dalam keluarga yang sama
            $table->unique(['kk_id', 'warga_id'], 'unique_anggota_keluarga');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anggota_keluarga');
    }
};
