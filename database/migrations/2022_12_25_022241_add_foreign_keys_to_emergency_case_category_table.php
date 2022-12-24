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
        Schema::table('emergency_case_category', function (Blueprint $table) {
            $table->foreign(['case_category_id'], 'FK_CaseCategory_EmergencyCategory')->references(['id'])->on('case_category')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['emergency_id'], 'FK_Emergency_EmergencyCategory')->references(['id'])->on('emergency')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('emergency_case_category', function (Blueprint $table) {
            $table->dropForeign('FK_CaseCategory_EmergencyCategory');
            $table->dropForeign('FK_Emergency_EmergencyCategory');
        });
    }
};
