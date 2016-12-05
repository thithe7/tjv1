<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMPointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_point', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('userid')->unsigned()->index();
            $table->bigInteger('id_trans')->unsigned()->index()->nullable();
            $table->integer('total_point')->nullable();
            $table->string('status', 10)->nullable();
            $table->timestamps();
            $table->foreign('userid')->references('id')->on('m_user');
            $table->foreign('id_trans')->references('id')->on('m_booking');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('m_point');
    }
}
