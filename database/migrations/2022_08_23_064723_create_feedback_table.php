<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->index('FK_UserID_Feedback');
            $table->string('title');
            $table->string('details');
            $table->integer('status')->default(1)->index('FK_FD-STATUS_ID');
            $table->timestamp('created_at')->useCurrent();

            $table->unique(['id'], 'feedback_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedback');
    }
}
