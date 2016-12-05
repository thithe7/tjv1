<?php

use Illuminate\Database\Seeder;

class MRoomTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        for ($i=1; $i < 41 ; $i++) {
            $nomorhotel = str_pad($i, 6, '0', STR_PAD_LEFT);
            for ($j=1; $j < 41 ; $j++) {
                $nomor = str_pad($j, 6, '0', STR_PAD_LEFT);
                DB::table('m_room')->insert([
                    'name' => 'Room '.$nomor.' HP'.$nomorhotel,
                    'hotel' => $i,
                    'stop_sell' => 'false',
                ]);
            }
        }
    }
}