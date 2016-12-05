<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMDailyAllotmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_daily_allotment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('priment')->unsigned()->index();
            $table->integer('allotment')->nullable();
            $table->date('date_daily')->nullable();
            $table->timestamps();
            $table->foreign('priment')->references('id')->on('m_priment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('m_daily_allotment');
    }
}
