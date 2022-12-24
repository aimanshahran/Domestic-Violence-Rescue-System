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
        Schema::table('notification', function (Blueprint $table) {
            $table->foreign(['read_status_id'], 'FK_ReadStatus')->references(['id'])->on('notification_read_status')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['receiver_id'], 'FK_UserID_Noti')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notification', function (Blueprint $table) {
            $table->dropForeign('FK_ReadStatus');
            $table->dropForeign('FK_UserID_Noti');
        });
    }
};
