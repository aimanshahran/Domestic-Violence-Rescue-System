<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergencyPhotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergency-photo', function (Blueprint $table) {
            $table->integer('ID', true);
            $table->integer('case_id')->index('FK_CaseID');
            $table->integer('user_id')->index('FK_UserID_EmerPhoto');
            $table->string('photo_name')->nullable();

            $table->unique(['ID'], 'photoID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emergency-photo');
    }
}
