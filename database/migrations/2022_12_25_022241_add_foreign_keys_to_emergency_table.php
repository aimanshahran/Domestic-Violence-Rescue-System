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
        Schema::table('emergency', function (Blueprint $table) {
            $table->foreign(['status'], 'FK_CaseStatus')->references(['id'])->on('case_status')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['user_id'], 'FK_UserID_Emergency')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['severity_status'], 'FK_SeverityStatus_ID')->references(['id'])->on('case_severity')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('emergency', function (Blueprint $table) {
            $table->dropForeign('FK_CaseStatus');
            $table->dropForeign('FK_UserID_Emergency');
            $table->dropForeign('FK_SeverityStatus_ID');
        });
    }
};
