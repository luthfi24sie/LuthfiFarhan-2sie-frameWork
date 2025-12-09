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
        Schema::create('keluarga_kk', function (Blueprint $table) {
            $table->increments('kk_id');
            $table->string('kk_nomor', 100)->unique();
            $table->foreignId('kepala_keluarga_warga_id')
                ->nullable()
                ->constrained('warga')
                ->nullOnDelete();
            $table->string('alamat', 255);
            $table->string('rt', 5)->nullable();
            $table->string('rw', 5)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluarga_kk');
    }
};
