<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('warga', function (Blueprint $table) {
            // tempat_lahir
            if (Schema::hasColumn('warga', 'tempat_lahir')) {
                $table->string('tempat_lahir', 50)->nullable()->change();
            } else {
                $table->string('tempat_lahir', 50)->nullable();
            }

            // tanggal_lahir
            if (Schema::hasColumn('warga', 'tanggal_lahir')) {
                $table->date('tanggal_lahir')->nullable()->change();
            } else {
                $table->date('tanggal_lahir')->nullable();
            }
            
            // agama
            if (Schema::hasColumn('warga', 'agama')) {
                $table->string('agama', 50)->nullable()->change();
            } else {
                $table->string('agama', 50)->nullable();
            }

            // status_perkawinan
            if (Schema::hasColumn('warga', 'status_perkawinan')) {
                $table->string('status_perkawinan', 50)->nullable()->change();
            } else {
                $table->string('status_perkawinan', 50)->nullable();
            }

            // pendidikan_terakhir
            if (Schema::hasColumn('warga', 'pendidikan_terakhir')) {
                $table->string('pendidikan_terakhir', 100)->nullable()->change();
            } else {
                $table->string('pendidikan_terakhir', 100)->nullable();
            }
            
            // alamat
            if (Schema::hasColumn('warga', 'alamat')) {
                $table->string('alamat', 200)->nullable()->change();
            } else {
                $table->string('alamat', 200)->nullable();
            }

            // rt
            if (Schema::hasColumn('warga', 'rt')) {
                $table->string('rt', 3)->nullable()->change();
            } else {
                $table->string('rt', 3)->nullable();
            }

            // rw
            if (Schema::hasColumn('warga', 'rw')) {
                $table->string('rw', 3)->nullable()->change();
            } else {
                $table->string('rw', 3)->nullable();
            }

            // kelurahan
            if (Schema::hasColumn('warga', 'kelurahan')) {
                $table->string('kelurahan', 50)->nullable()->change();
            } else {
                $table->string('kelurahan', 50)->nullable();
            }

            // kecamatan
            if (Schema::hasColumn('warga', 'kecamatan')) {
                $table->string('kecamatan', 50)->nullable()->change();
            } else {
                $table->string('kecamatan', 50)->nullable();
            }

            // kabupaten_kota
            if (Schema::hasColumn('warga', 'kabupaten_kota')) {
                $table->string('kabupaten_kota', 50)->nullable()->change();
            } else {
                $table->string('kabupaten_kota', 50)->nullable();
            }

            // provinsi
            if (Schema::hasColumn('warga', 'provinsi')) {
                $table->string('provinsi', 50)->nullable()->change();
            } else {
                $table->string('provinsi', 50)->nullable();
            }
            
            // status_kependudukan
            if (Schema::hasColumn('warga', 'status_kependudukan')) {
                $table->string('status_kependudukan', 50)->nullable()->change();
            } else {
                $table->string('status_kependudukan', 50)->nullable();
            }

            // kewarganegaraan
            if (Schema::hasColumn('warga', 'kewarganegaraan')) {
                $table->string('kewarganegaraan', 50)->nullable()->default('Indonesia')->change();
            } else {
                $table->string('kewarganegaraan', 50)->nullable()->default('Indonesia');
            }
        });
    }

    public function down()
    {
        // No safe reverse
    }
};
