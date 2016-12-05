<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_admin')->insert([
            'username' => 'admin',
            'email' => 'admin@traveljinni.com',
            'password' => bcrypt('admin'),
            'status' => 'active',
        ]);
    }
}
