<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $m = 1;
    	for ($i=1; $i < 11; $i++) {
    		for ($j=1; $j < 6; $j++) {
		        DB::table('m_point')->insert([
		            'userid' => $i,
		            'id_trans' => $m,
		            'total_point' => $faker->numberBetween(1000,9999),
		            'status' => 'active'
		        ]);
		        $m++;
    		}
    	}
    }
}
