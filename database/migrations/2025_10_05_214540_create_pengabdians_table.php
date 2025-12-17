<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengabdian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ketua_dosen_id');
            $table->string('judul');
            $table->year('tahun');
            $table->timestamps();

            $table->foreign('ketua_dosen_id')
                ->references('id')
                ->on('dosens')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengabdian');
    }
};
