<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('editor_id')->index('FK_UserID_Posts');
            $table->string('title');
            $table->string('content')->nullable();
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('edit_at')->useCurrentOnUpdate()->default('0000-00-00 00:00:00');

            $table->unique(['id'], 'post_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
