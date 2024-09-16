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
        Schema::table('formatlaporans', function (Blueprint $table) {
            $table->unsignedBigInteger('pekerjaan_id')->after('opd_id')->nullable();
            $table->foreign('pekerjaan_id')->references('id')->on('pekerjaans')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('formatlaporans', function (Blueprint $table) {
            $table->dropForeign(['pekerjaan_id']);
            $table->dropColumn('pekerjaan_id');
        });
    }
};
