<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('warga')) {
            Schema::create('warga', function (Blueprint $table) {
                $table->id('warga_id');
                $table->string('no_ktp', 32)->unique();
                $table->string('nama');
                $table->enum('jenis_kelamin', ['L', 'P']);
                $table->string('agama')->nullable();
                $table->string('pekerjaan')->nullable();
                $table->string('telp')->nullable();
                $table->string('email')->nullable();
                $table->timestamps();
            });
        } else {
            Schema::table('warga', function (Blueprint $table) {
                if (!Schema::hasColumn('warga', 'nama')) {
                    $table->string('nama')->after('no_ktp');
                }
            });
        }
    }
    public function down(): void {
        Schema::dropIfExists('warga');
    }
};
