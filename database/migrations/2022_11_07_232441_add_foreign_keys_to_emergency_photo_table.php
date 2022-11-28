<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToEmergencyPhotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('emergency_photo', function (Blueprint $table) {
            $table->foreign(['case_id'], 'FK_CaseID')->references(['id'])->on('emergency')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['user_id'], 'FK_UserID_EmerPhoto')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
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
            $table->dropForeign('FK_UserID_EmerPhoto');
        });
    }
}
