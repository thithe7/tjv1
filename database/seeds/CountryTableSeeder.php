<?php

use Illuminate\Database\Seeder;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_country')->insert([
            'code' => 'ID',
            'name' => 'Indonesia',
            'phone_code' => '62',
        ]);
    }
}
