<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DBookingSeeder extends Seeder
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
    			for ($k=0; $k < 4; $k++) {
			        DB::table('d_booking')->insert([
			            'id_booking' => $m,
			            'p_name' => 'user'.$i,
			            'price' => $faker->numberBetween(1000000,9999999),
			        ]);
    			}
		        $m++;
    		}
    	}
    }
}
