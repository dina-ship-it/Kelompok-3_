<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penelitians', function (Blueprint $table) {
            // tambahkan kolom tahun (boleh null)
            $table->integer('tahun')->nullable()->after('mahasiswa_dok');
        });
    }

    public function down(): void
    {
        Schema::table('penelitians', function (Blueprint $table) {
            $table->dropColumn('tahun');
        });
    }
};
