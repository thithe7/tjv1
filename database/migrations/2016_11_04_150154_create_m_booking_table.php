<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_booking', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('room')->unsigned()->index();
            $table->bigInteger('userid')->unsigned()->index()->nullable();
            $table->string('name_pemesan', 200);
            $table->string('email_pemesan', 200);
            $table->string('telp_pemesan', 200);
            $table->date('checkin');
            $table->date('checkout');
            $table->integer('qty');
            $table->double('original_price');
            $table->double('sell_price');
            $table->string('status', 10)->nullable();
            $table->bigInteger('voucher')->nullable();
            $table->string('breakfast', 100)->nullable();
            $table->string('amenities', 100)->nullable();
            $table->double('breakfast_price')->nullable();
            $table->double('amenities_price')->nullable();
            $table->timestamps();
            $table->foreign('room')->references('id')->on('m_room');
            $table->foreign('userid')->references('id')->on('m_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('m_booking');
    }
}
