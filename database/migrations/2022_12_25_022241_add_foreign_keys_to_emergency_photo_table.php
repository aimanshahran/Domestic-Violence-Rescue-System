<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('emergency_photo', function (Blueprint $table) {
            $table->foreign(['emergency_id'], 'FK_CaseID')->references(['id'])->on('emergency')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('emergency_photo', function (Blueprint $table) {
            $table->dropForeign('FK_CaseID');
        });
    }
};
