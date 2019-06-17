<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class userTableSeederr extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $user=new User;
        $user->name = 'Marquebreucq';
        $user->email ='gregorovitz@outlook.be';
        $user->password = Hash::make('Gregorovitz201');
        $user->firstname='Emmanuel';
        $user->assignRole('super-admin');
        $user->street='avenue des combattants';
        $user->streetNum='60';
        $user->phone='0476983038';
        $user->cityId=482;


        $user->save();
        $user=new User;
        $user->name = 'Marquebreucq';
        $user->email ='emanumarque@gmail.com';
        $user->password = Hash::make('Gregorovitz201');
        $user->firstname='manu';
        $user->assignRole('visitor');
        $user->street='avenue des combattants';
        $user->streetNum='60';
        $user->phone='0476983038';
        $user->cityId=482;

        $user->save();

        $user->save();
        $user=new User;
        $user->name = 'Marque-breucq';
        $user->email ='e.marquebreucq@students.ephec.be';
        $user->password = Hash::make('Gregorovitz201');
        $user->firstname='Emma';
        $user->assignRole('gestionnaire de salle');
        $user->street='avenue des combattants';
        $user->streetNum='60';
        $user->phone='0476983038';
        $user->cityId=482;

        $user->save();

        $user=new User;
        $user->name = 'marque';
        $user->email ='manumarquebreucq@ymail.com';
        $user->password = Hash::make('Gregorovitz201');
        $user->firstname='manu';
        $user->assignRole('trésorier');
        $user->street='avenue des combattants';
        $user->streetNum='60';
        $user->phone='0476983038';
        $user->cityId=482;

        $user->save();

    }

}
