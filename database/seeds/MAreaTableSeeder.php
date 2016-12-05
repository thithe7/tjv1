<?php

use Illuminate\Database\Seeder;

class MAreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_area')->insert([
            'code' => 'TJA000001',
            'name' => 'belum ditentukan',
            'city' => '1',
        ]);
    }
}
