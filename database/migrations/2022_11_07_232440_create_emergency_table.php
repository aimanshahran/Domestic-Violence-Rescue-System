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
            $table->integer('user_id')->index('FK_UserID_Emergency')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('details')->nullable();
            $table->integer('severity_status')->index('FK_SeverityStatus_ID')->nullable();
            $table->integer('status')->default(1)->index('FK_CaseStatus');
            $table->string('remarks')->nullable();
            $table->timestamp('created_at')->useCurrent();
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
        Schema::dropIfExists('emergency');
    }
}
