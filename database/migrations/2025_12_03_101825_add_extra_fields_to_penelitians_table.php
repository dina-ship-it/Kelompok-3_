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
            $table->string('ketua_manual')->nullable()->after('dosen_id');

            // anggota peneliti (selain ketua)
            $table->text('peneliti')->nullable()->after('status');

            // mahasiswa penanggung jawab dokumentasi
            $table->string('mahasiswa_dok')->nullable()->after('peneliti');
        });
    }

    public function down(): void
    {
        Schema::table('penelitians', function (Blueprint $table) {
            $table->dropColumn(['ketua_manual', 'peneliti', 'mahasiswa_dok']);
        });
    }
};
