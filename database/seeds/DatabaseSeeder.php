<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(MAreaTableSeeder::class);
        $this->call(MHotelTableSeeder::class);
        $this->call(VendorTableSeeder::class);
        $this->call(MContractHotelTableSeeder::class);
        $this->call(MRoomTableSeeder::class);
        $this->call(MPrimentTableSeeder::class);
        $this->call(MConfigSeeder::class);
        $this->call(MBookingSeeder::class);
        $this->call(DBookingSeeder::class);
        $this->call(MPointSeeder::class);
        $this->call(MVendorTypeSeeder::class);
    }
}
