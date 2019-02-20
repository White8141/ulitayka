<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name', 20);
            
            $table->string('user_first_name_ru', 20)->nullable();
            $table->string('user_last_name_ru', 20)->nullable();
            $table->string('user_first_name_en', 20)->nullable();
            $table->string('user_last_name_en', 20)->nullable();
            $table->string('user_adress', 40)->nullable();
            $table->string('user_phone', 14)->nullable();
            $table->string('user_passport', 40)->nullable();
            $table->char('user_birthdate', 10)->nullable();
            $table->boolean('user_profile_filled')->default(false);

            $table->string('email', 64)->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
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
