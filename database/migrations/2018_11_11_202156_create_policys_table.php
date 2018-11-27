<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePolicysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('policy_name', 20)->nullable();
            $table->string('company_id', 10);
            $table->integer('status')->unsigned()->default(0);

            $table->string('policy_number')->nullable();
            $table->string('policy_currency', 3)->nullable();
            $table->string('insurance_programm_uid')->nullable();
            $table->char('policy_period_from', 10)->nullable();
            $table->char('policy_period_till', 10)->nullable();
            $table->decimal('policy_cost')->nullable();

            $table->boolean('additional_condition_0')->default(false);
            $table->boolean('additional_condition_1')->default(false);
            $table->boolean('additional_condition_2')->default(false);

            $table->string('link')->nullable();
            $table->string('comments', 500)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('policies');
    }

}
