<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPostsPhotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts_photo', function (Blueprint $table) {
            $table->foreign(['blog_id'], 'FK_BlogID_PostPhoto')->references(['id'])->on('posts')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts_photo', function (Blueprint $table) {
            $table->dropForeign('FK_BlogID_PostPhoto');
        });
    }
}
