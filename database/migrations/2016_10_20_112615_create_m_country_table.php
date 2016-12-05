<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMCountryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_country', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 20)->unique();
            $table->string('name', 50)->unique();
            $table->string('phone_code', 10)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('m_country');
    }
}
