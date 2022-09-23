<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name')->nullable();
            $table->string('email')->unique('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone', 12)->nullable()->unique('phone');
            $table->string('password');
            $table->rememberToken();
            $table->integer('gender_id')->nullable()->index('FK_Gender');
            $table->string('photo')->nullable();
            $table->integer('role_id')->default(2)->index('FK_Role');
            $table->timestamp('created_at')->default('0000-00-00 00:00:00');
            $table->timestamp('updated_at')->useCurrent();

            $table->unique(['id'], 'id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
