<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_priment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('room')->unsigned()->index();
            $table->integer('allotement');
            $table->integer('max_allotement');
            $table->float('best_value');
            $table->float('vlm_value');
            $table->float('amenities');
            $table->float('breakfast');
            $table->date('valid_from');
            $table->date('valid_to');
            $table->timestamps();
            $table->foreign('room')->references('id')->on('m_room');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('m_priment');
    }
}
