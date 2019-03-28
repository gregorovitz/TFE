<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use App\Events;
class CalendrierVisitorController extends Controller
{
    public function show($room){


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
//              $name='';
                if (Auth::user()->cannot('display-intern-calendar')) {
                    if ($event->color == 'blue') {
                        $color = 'red';
                        $name='occupé';
                    } else {
                        $color = $event->color;
                        $name=$event->name;
                    }
                }else{
                    $color = $event->color;
                    $name=$event->name;
                }
                if($event->url =='event'){
                    $idEvent=$event->id;
                }else{
                    $idEvent=$event->interne->id;

                }


                $events_List[]=Calendar::event(

                    $name,
                    false,
                    new \DateTime($event->start_date.$event->startime),
                    new \DateTime($event->end_date.$event->endtime),
                    null,
                    // Add color and link on event

                    [
                        'color' => $color,
                        'url'=>'/'.$event->url.'/'.$idEvent,
                    ]
                );
            }
        }
        if (Auth::user()->can('display-intern-calendar')){
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
                'dayClick'=>"function(date){
            var date1=date.format('YYYY-MM-DD');
            var hour=date.format('hh:mm:ss');
            var room=$room;
           window.location.href='/eventInterne/'+date1+'/'+hour+'/'+room+'/activite';;
           }",
                'eventClick'=>"function(event) {
                if (event.url) {
                    document.location.replace(event.url);
                    return false;
                }
            }"
            ]);
        }
        else{
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
               /* 'dayClick'=> "function(date) {
                $('#myModal').modal();
                var date1=date.format();
                $('#room').val($room);
                $('#start').val(date1);
                $('#end').val(date1);
                return false
                    }",*/
               'dayClick'=>"function(date){
                var date1=date.format('YYYY-MM-DD');
                var hour=date.format('hh:mm:ss');
                var room=$room;
               window.location.href='/event/'+date1+'/'+hour+'/'+room+'/location';
               }",
                'eventClick'=>"function(event) {
                    if (event.url) {
                        window.open(event.url);
                        return false;
                    }
                }"
            ]);
        }
        return view('calendar.calendar',compact('calendar_details'));
    }



}
