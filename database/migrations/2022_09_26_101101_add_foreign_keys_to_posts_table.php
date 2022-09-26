<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->foreign(['photo_id'], 'FK_PhotoID_Posts')->references(['id'])->on('posts_photo')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['editor_id'], 'FK_UserID_Posts')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('FK_PhotoID_Posts');
            $table->dropForeign('FK_UserID_Posts');
        });
    }
}
