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
        Schema::create('formatlaporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('opd_id')->constrained();
            $table->string('bidang');
            $table->string('pekerjaan');
            $table->string('kabid');
            $table->text('latar_belakang');
            $table->string('maksud_tujuan');
            $table->string('ruang_lingkup');
            $table->string('logo_dinas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formatlaporans');
    }
};
