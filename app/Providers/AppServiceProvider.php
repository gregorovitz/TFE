<?php

namespace App\Providers;
use App\Room;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            /*$items = Room::all()->map(function (Room $room) {
                return [
                    'text' => $room['name'],
                    'url' => 'location/'.$room['id']
                ];
            });*/
            $rooms=Room::all();
            $submenu=[];
            foreach ($rooms as $room){
                if ($room['id']!=1){
                $submenu[]=[
                    'text' => $room['name'],
                    'icon'=>'calendar',
                    'url' => 'location/'.$room['id']
                ];
                }
            }

            $event->menu->add([

                'text'    => 'app.Booking',
                'icon'    => 'share',
                'can'   =>'display-calendar',
                'submenu' =>$submenu
                 ]);




        });
    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
