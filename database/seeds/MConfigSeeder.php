<?php

use Illuminate\Database\Seeder;

class MConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_config')->insert([
            'point' 		=> 1,
            'point_value' 	=> 1000,
            'created_at' 	=> date('Y-m-d')
        ]);
    }
}
