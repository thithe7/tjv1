<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_user_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_user')->unsigned()->index();
            $table->string('phone', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('postcode', 10)->nullable();
            $table->text('address')->nullable();
            $table->date('brithdate')->nullable();
            $table->string('forgotpassword', 200)->nullable();
            $table->boolean('status_newsletter', 200)->nullable();
            $table->timestamps();
            $table->foreign('id_user')->references('id')->on('m_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('m_user_details');
    }
}
