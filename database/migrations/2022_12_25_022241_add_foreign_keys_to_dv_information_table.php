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
        Schema::table('dv_information', function (Blueprint $table) {
            $table->foreign(['category_id'], 'FK_CatID_DVCat')->references(['id'])->on('dv_category')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['user_id'], 'FK_UserID_DVInfo')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dv_information', function (Blueprint $table) {
            $table->dropForeign('FK_CatID_DVCat');
            $table->dropForeign('FK_UserID_DVInfo');
        });
    }
};
