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
            $table->string('name');
            
            $table->string('user_first_name_ru')->nullable();
            $table->string('user_last_name_ru')->nullable();
            $table->string('user_first_name_en')->nullable();
            $table->string('user_last_name_en')->nullable();
            $table->string('user_adress')->nullable();
            $table->string('user_phone')->nullable();
            $table->string('user_passport')->nullable();
            $table->string('user_birthdate')->nullable();
            $table->boolean('user_profile_filled')->default(false);

            $table->string('email')->nullable();
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
