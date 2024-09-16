<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('formatlaporan_id')->nullable();
            $table->foreign('formatlaporan_id')->references('id')->on('formatlaporans')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['formatlaporan_id']);
            $table->dropColumn('formatlaporan_id');
        });
    }
};
