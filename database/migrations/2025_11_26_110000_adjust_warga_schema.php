<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Pastikan kolom primary key konsisten dengan model (warga_id)
        if (Schema::hasTable('warga')) {
            if (! Schema::hasColumn('warga', 'warga_id') && Schema::hasColumn('warga', 'id')) {
                DB::statement('ALTER TABLE `warga` CHANGE `id` `warga_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');
            }

            // Tambahkan kolom no_ktp jika belum ada
            if (! Schema::hasColumn('warga', 'no_ktp')) {
                DB::statement('ALTER TABLE `warga` ADD `no_ktp` VARCHAR(16) NULL AFTER `warga_id`');
                DB::statement('ALTER TABLE `warga` ADD UNIQUE (`no_ktp`)');
            }
        }
    }

    public function down(): void
    {
        // Tidak di-rollback untuk menjaga konsistensi dengan model
    }
};

