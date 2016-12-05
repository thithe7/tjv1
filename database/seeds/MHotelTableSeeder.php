<?php

use Illuminate\Database\Seeder;

class MHotelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        for ($i=1; $i < 41 ; $i++) {
            $nomor = str_pad($i, 6, '0', STR_PAD_LEFT);
            DB::table('m_hotel')->insert([
                'code' => 'TJH'.$nomor,
                'name' => 'Hotel Percobaan'.$nomor,
                'email' => 'hotel@percobaan'.$nomor.'.com',
                'phone' => '080989999',
                'star_rate' => '3',
                'address' => 'Jl. Coba Coba'.$nomor,
                'lat' => '+1',
                'long' => '-1',
                'area' => '1',
            ]);
        }
    }
}
