<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MBookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();
    	for ($i=1; $i < 11; $i++) {
    		for ($j=1; $j < 6; $j++) {
		        DB::table('m_booking')->insert([
		            'room' => $i*$j,
		            'userid' => $i,
		            'name_pemesan' => 'user'.$i,
		            'email_pemesan' => 'user'.$i.'@traveljinni.com',
		            'telp_pemesan' => $faker->phoneNumber,
		            'checkin' => date('2016-12-12'),
		            'checkout' => date('2016-12-16'),
		            'qty' => $faker->numberBetween(1,9),
		            'original_price' => $faker->numberBetween(1000000,9999999),
		            'sell_price' => $faker->numberBetween(1000000,9999999),
		            'status' => 'paid',
		        ]);
    		}
    	}
    }
}
