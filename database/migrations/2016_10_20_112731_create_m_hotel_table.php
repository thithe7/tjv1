<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMHotelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_hotel', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('fax')->nullable();
            $table->string('website')->nullable();
            $table->integer('star_rate');
            $table->string('address');
            $table->bigInteger('area')->unsigned()->index();
            $table->string('lat');
            $table->string('long');
            // Contact Person
            $table->string('cp_name')->nullable();
            $table->string('cp_phone')->nullable();
            $table->string('cp_mail')->nullable();
            $table->string('cp_title')->nullable();
            $table->string('cp_department')->nullable();
            $table->timestamps();
            $table->foreign('area')->references('id')->on('m_area');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('m_hotel');
    }
}
