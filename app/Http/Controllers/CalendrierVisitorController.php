<?php

namespace App\Http\Controllers;

use App\TypeEvents;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use App\Events;
class CalendrierVisitorController extends Controller
{
    public function show($room){
        $typesEvents=TypeEvents::pluck('name','id');

        if($room==1 ) {

                $room = 2;
                $events = Events::where('roomId', $room)->get();
                echo('salut');

        }else{
            $events=Events::where('roomId',$room)->get();
        }
        $events_List=[];
        if ($events->count()){
            foreach ($events as $key =>$event){
//                print_r($event) ;
                if ($event->color =='blue'){
                    $color='red';
                }else{
                    $color=$event->color;
                }

                $events_List[]=Calendar::event(

                    $event->name,
                    false,
                    new \DateTime($event->start_date.$event->startime),
                    new \DateTime($event->end_date.$event->endtime),
                    null,
                    // Add color and link on event

                    [
                        'color' => $color,
                        'url'=>'/event/'.$event->id,
                    ]
                );
            }
        }

        $calendar_details=Calendar::addEvents($events_List)->setOptions([
            'defaultView'=>'agendaWeek',
            'selectable'=>'true',
            "businessHours: {
            // days of week. an array of zero-based day of week integers (0=Sunday)
            dow: [0, 1, 2, 3, 4, 5, 6], // Monday - Thursday
            start: '09:00', // a start time (10am in this example)
            end: '00:00', // an end time (6pm in this example)
                            }",
            'allDay'=>'false',
            'locale'=>'fr'

        ])->setCallbacks([
            'dayClick'=> "function(date) {
            $('#myModal').modal();
            var date1=date.format();
            $('#room').val($room);
            $('#start').val(date1);
            $('#end').val(date1);
            return false
                }",
            'eventClick'=>"function(event) {
                if (event.url) {
                    window.open(event.url);
                    return false;
                }
            }"
        ]);

        return view('calendar.calendar',compact('calendar_details','typesEvents'));
    }



}
