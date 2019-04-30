<?php

use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $room=\App\Room::create(['name'=>'all']);
        $room=\App\Room::create(['name'=>'Grande Salle']);
//        $room=\App\Room::create(['name'=>'salle Foyer']);
//        $room=\App\Room::create(['name'=>'Vents-du-Sud']);
    }
}
