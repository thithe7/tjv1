<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMCityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_city', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 20)->unique();
            $table->string('name', 50)->unique();
            $table->string('province', 50);
            $table->bigInteger('country')->unsigned()->index();
            $table->timestamps();
            $table->foreign('country')->references('id')->on('m_country');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('m_city');
    }
}
