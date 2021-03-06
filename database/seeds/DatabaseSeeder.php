<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CitiesTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(RoomSeeder::class);
        $this->call(OrganisationSeeder::class);
        $this->call(userTableSeederr::class);

    }
}
