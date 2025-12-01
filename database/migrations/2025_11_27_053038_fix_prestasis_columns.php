<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('prestasis', function (Blueprint $table) {
            // tambah kolom kalau belum ada
            if (!Schema::hasColumn('prestasis', 'code')) {
                $table->string('code')->nullable()->after('id');
            }
            if (!Schema::hasColumn('prestasis', 'nama')) {
                // tambahkan field nama (opsional, agar kompatibel kalau ada kode yang pakai 'nama')
                $table->string('nama')->nullable()->after('code');
            }
            if (!Schema::hasColumn('prestasis', 'nama_prestasi')) {
                $table->string('nama_prestasi')->nullable()->after('nama');
            } else {
                // jika sudah ada tetapi NOT NULL, ubah menjadi NULLABLE via raw SQL
                DB::statement("ALTER TABLE `prestasis` MODIFY `nama_prestasi` VARCHAR(255) NULL;");
            }
            if (!Schema::hasColumn('prestasis', 'skor_sinta')) {
                $table->integer('skor_sinta')->nullable()->after('nama_prestasi');
            }
            if (!Schema::hasColumn('prestasis', 'skor_sinta_3yr')) {
                $table->integer('skor_sinta_3yr')->nullable()->after('skor_sinta');
            }
            if (!Schema::hasColumn('prestasis', 'jumlah_buku')) {
                $table->integer('jumlah_buku')->nullable()->after('skor_sinta_3yr');
            }
            if (!Schema::hasColumn('prestasis', 'jumlah_hibah')) {
                $table->integer('jumlah_hibah')->nullable()->after('jumlah_buku');
            }
            if (!Schema::hasColumn('prestasis', 'publikasi_scholar')) {
                $table->integer('publikasi_scholar')->nullable()->after('jumlah_hibah');
            }
        });
    }

    public function down()
    {
        Schema::table('prestasis', function (Blueprint $table) {
            // hanya drop kolom yang kita tambahkan (jika ingin rollback)
            $cols = [];
            if (Schema::hasColumn('prestasis','publikasi_scholar')) $cols[] = 'publikasi_scholar';
            if (Schema::hasColumn('prestasis','jumlah_hibah')) $cols[] = 'jumlah_hibah';
            if (Schema::hasColumn('prestasis','jumlah_buku')) $cols[] = 'jumlah_buku';
            if (Schema::hasColumn('prestasis','skor_sinta_3yr')) $cols[] = 'skor_sinta_3yr';
            if (Schema::hasColumn('prestasis','skor_sinta')) $cols[] = 'skor_sinta';
            if (Schema::hasColumn('prestasis','nama_prestasi')) $cols[] = 'nama_prestasi';
            if (Schema::hasColumn('prestasis','nama')) $cols[] = 'nama';
            if (Schema::hasColumn('prestasis','code')) $cols[] = 'code';

            if (!empty($cols)) {
                $table->dropColumn($cols);
            }
        });
    }
};
