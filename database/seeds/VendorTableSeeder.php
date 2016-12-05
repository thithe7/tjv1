<?php

use Illuminate\Database\Seeder;

class VendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_vendor')->insert([
            'username' => 'vendor',
            'email' => 'vendor@traveljinni.com',
            'password' => bcrypt('vendor'),
            'hotel' => '1',
            'status' => 'active',
        ]);
    }
}
