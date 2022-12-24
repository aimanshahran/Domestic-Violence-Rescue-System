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
        Schema::create('emergency_case_category', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('emergency_id')->index('FK_Emergency_EmergencyCategory');
            $table->integer('case_category_id')->index('FK_CaseCategory_EmergencyCategory');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emergency_case_category');
    }
};
