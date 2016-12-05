<?php

use Illuminate\Database\Seeder;

class MPrimentTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_priment')->insert([
            'room' => '1',
            'allotement' => '10',
            'max_allotement' => '10',
            'best_value' => '300000',
            'vlm_value' => '150000',
            'amenities' => '50000',
            'breakfast' => '50000',
            'valid_from' => '2016-01-01',
            'valid_to' => '2016-12-31',
        ]);
    }
}
