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
        Schema::table('case_category', function (Blueprint $table) {
            $table->foreign(['severity_status_ID'], 'FK_SeverityStatusID_CaseCategory')->references(['id'])->on('case_severity')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('case_category', function (Blueprint $table) {
            $table->dropForeign('FK_SeverityStatusID_CaseCategory');
        });
    }
};
