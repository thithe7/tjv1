<?php

use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_city')->insert([
            'code' => 'DPS',
            'name' => 'Denpasar',
            'province' => 'Bali',
            'country' => '1',
        ]);
    }
}
