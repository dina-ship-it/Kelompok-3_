<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('penelitians', function (Blueprint $table) {
            $table->unsignedBigInteger('mahasiswa_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('penelitians', function (Blueprint $table) {
            $table->unsignedBigInteger('mahasiswa_id')->nullable(false)->change();
        });
    }
};
