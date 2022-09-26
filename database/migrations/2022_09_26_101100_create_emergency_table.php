<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergency', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->index('FK_UserID_Emergency');
            $table->string('longitude');
            $table->string('latitude');
            $table->string('address', 2555)->nullable();
            $table->string('details')->nullable();
            $table->integer('severity_status')->index('FK_SeverityStatus_ID');
            $table->integer('status')->default(1)->index('FK_CaseStatus');
            $table->string('remarks')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emergency');
    }
}
