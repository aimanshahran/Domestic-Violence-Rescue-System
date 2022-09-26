<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign(['gender_id'], 'FK_Gender')->references(['id'])->on('gender')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['role_id'], 'FK_Role')->references(['id'])->on('role')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('FK_Gender');
            $table->dropForeign('FK_Role');
        });
    }
}
