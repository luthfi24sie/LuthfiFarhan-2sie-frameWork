<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('warga', function (Blueprint $table) {
            if (Schema::hasColumn('warga', 'nik')) {
                $table->string('nik', 16)->nullable()->change();
            }
            if (Schema::hasColumn('warga', 'nama_lengkap')) {
                $table->string('nama_lengkap', 100)->nullable()->change();
            }
        });
    }

    public function down()
    {
        // No safe reverse operation as we don't know original state
    }
};
