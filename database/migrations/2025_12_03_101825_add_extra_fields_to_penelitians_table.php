<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penelitians', function (Blueprint $table) {

            // nama ketua manual (kalau tidak pilih dari dosen)
            if (!Schema::hasColumn('penelitians', 'ketua_manual')) {
                $table->string('ketua_manual')->nullable()->after('dosen_id');
            }

            // anggota peneliti (selain ketua)
            if (!Schema::hasColumn('penelitians', 'peneliti')) {
                $table->text('peneliti')->nullable()->after('status');
            }

            // mahasiswa penanggung jawab dokumentasi
            if (!Schema::hasColumn('penelitians', 'mahasiswa_dok')) {
                $table->string('mahasiswa_dok')->nullable()->after('peneliti');
            }
        });
    }

    public function down(): void
    {
        Schema::table('penelitians', function (Blueprint $table) {

            if (Schema::hasColumn('penelitians', 'ketua_manual')) {
                $table->dropColumn('ketua_manual');
            }

            if (Schema::hasColumn('penelitians', 'peneliti')) {
                $table->dropColumn('peneliti');
            }

            if (Schema::hasColumn('penelitians', 'mahasiswa_dok')) {
                $table->dropColumn('mahasiswa_dok');
            }
        });
    }
};
