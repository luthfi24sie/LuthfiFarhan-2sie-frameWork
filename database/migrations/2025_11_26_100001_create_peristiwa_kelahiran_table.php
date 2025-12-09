<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('peristiwa_kelahiran')) {
            return;
        }
        Schema::create('peristiwa_kelahiran', function (Blueprint $table) {
            $table->increments('kelahiran_id');
            $table->foreignId('warga_id')->constrained('warga')->cascadeOnDelete();
            $table->date('tgl_lahir');
            $table->string('tempat_lahir', 120)->nullable();
            $table->foreignId('ayah_warga_id')->nullable()->constrained('warga')->nullOnDelete();
            $table->foreignId('ibu_warga_id')->nullable()->constrained('warga')->nullOnDelete();
            $table->string('no_akta', 100)->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peristiwa_kelahiran');
    }
};
