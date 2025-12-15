<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengabdiansTable extends Migration
{
    public function up()
    {
        Schema::create('pengabdians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ketua_dosen_id'); // FK ke dosens
            $table->string('judul');
            $table->string('bidang')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->string('status')->nullable();
            $table->text('anggota')->nullable(); // daftar nama anggota
            $table->string('mahasiswa_penanggung_jawab')->nullable();
            $table->year('tahun')->nullable();
            $table->timestamps();

            $table->foreign('ketua_dosen_id')->references('id')->on('dosens')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengabdians');
    }
}
