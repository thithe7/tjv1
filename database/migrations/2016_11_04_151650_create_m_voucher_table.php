<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMVoucherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_voucher', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('userid')->unsigned()->index();
            $table->bigInteger('id_point')->unsigned()->index();
            $table->string('code', 100);
            $table->string('status', 10);
            $table->date('expired');
            $table->timestamps();
            $table->foreign('userid')->references('id')->on('m_user');
            $table->foreign('id_point')->references('id')->on('m_point');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('m_voucher');
    }
}
