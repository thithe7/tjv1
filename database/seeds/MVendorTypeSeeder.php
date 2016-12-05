<?php

use Illuminate\Database\Seeder;

class MVendorTypeSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
    	$data = ['Hotel', 'Restaurant', 'Spa'];
    	foreach ($data as $row) {
	        DB::table('m_vendor_type')->insert([
	            'name' => $row->name,
	            'created_at' => date('Y-m-d')
	        ]);
    	}
    }
}
