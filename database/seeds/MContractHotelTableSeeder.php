<?php

use Illuminate\Database\Seeder;

class MContractHotelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_contract_hotel')->insert([
            'hotel' => '1',
            'cut_of_date' => '3',
            'valid_from' => '2016-01-01',
            'valid_to' => '2016-12-31',
        ]);
    }
}
