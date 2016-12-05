<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_area', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 20)->unique();
            $table->string('name', 50)->unique();
            $table->bigInteger('city')->unsigned()->index();
            $table->timestamps();
            $table->foreign('city')->references('id')->on('m_city');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('m_area');
    }
}
