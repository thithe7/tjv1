<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 11; $i++) { 
            DB::table('m_user')->insert([
                'username' => 'user'.$i,
                'name' => 'user ke '.$i,
                'email' => 'user'.$i.'@traveljinni.com',
                'password' => bcrypt('user'.$i),
                'status' => 'active',
            ]);
        }
    }
}
