<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('warga')) {
            return;
        }

        if (Schema::hasColumn('warga', 'nama')) {
            return;
        }

        if (Schema::hasColumn('warga', 'nama_lengkap')) {
            DB::statement('ALTER TABLE `warga` CHANGE `nama_lengkap` `nama` VARCHAR(255) NULL');
            return;
        }

        if (Schema::hasColumn('warga', 'name')) {
            DB::statement('ALTER TABLE `warga` CHANGE `name` `nama` VARCHAR(255) NULL');
            return;
        }

        DB::statement('ALTER TABLE `warga` ADD `nama` VARCHAR(255) NULL AFTER `no_ktp`');
    }

    public function down(): void
    {
    }
};

