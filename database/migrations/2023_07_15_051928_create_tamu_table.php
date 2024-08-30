<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tamu', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tamu',50)->required();
            $table->string('no_telepon',12)->required();
            $table->string('nama_instansi',30)->required();
            $table->string('keperluan',50)->required();
            $table->string('bertemu_dengan',50)->required();
            $table->date('tanggal_bertamu')->required();
            $table->time('waktu')->required();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tamu');
    }
};
