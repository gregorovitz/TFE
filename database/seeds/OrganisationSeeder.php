<?php

use Illuminate\Database\Seeder;

class OrganisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organisation=\App\Organisation::create(['name'=>'Autres']);
        $organisation=\App\Organisation::create(['name'=>'Organisation étudiante UCL']);
        $organisation=\App\Organisation::create(['name'=>'ASBL']);
    }
}
