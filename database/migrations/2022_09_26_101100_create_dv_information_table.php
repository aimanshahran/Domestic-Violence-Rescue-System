<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDvInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dv_information', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('content')->nullable();
            $table->integer('category_id')->index('FK_CatID_DVCat');
            $table->integer('user_id')->index('FK_UserID_DVInfo');
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dv_information');
    }
}
