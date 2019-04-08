<?php

use Illuminate\Database\Seeder;


class test extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeorganisation=\App\TypeOrganisation::create(['name'=>'none']);
        $organisation=\App\Organisation::create(['name'=>'none','typeOrganisationId'=>1]);
        $organisation=factory(App\Organisation::class,3)->create();
        $typesEvent=factory(App\TypeEvents::class,3)->create();
        $room=\App\Room::create(['name'=>'all']);

        $sector=\App\Secteur::create(['name'=>'CEC']);
        DB::table('Rooms')->insert(
            array('name'=>'Grande Salle'),
            array('name'=>'salle 2')
        );

    }
}
