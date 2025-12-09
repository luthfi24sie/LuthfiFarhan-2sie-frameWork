<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('bukti_media')) {
            return;
        }
        Schema::create('bukti_media', function (Blueprint $table) {
            $table->id();
            $table->string('model'); // peristiwa_kelahiran | peristiwa_kematian | peristiwa_pindah
            $table->unsignedBigInteger('model_id');
            $table->string('file_path', 255);
            $table->timestamps();

            $table->index(['model', 'model_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bukti_media');
    }
};
