<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Events;

class EventsController extends Controller
{
    public function index(){

        $events=Events::get();
        $events_List=[];
        if ($events->count()){
            foreach ($events as $key =>$event){
                $events_List[]=Calendar::event(
                    $event->event_name,
                    true,
                    new \DateTime($event->start_date),
                    new \DateTime($event->end_date.' +1 day'),
                    null,
                    // Add color and link on event
                    [

                        'color' => '#ff0000',
                        'url' => 'pass here url and any route',
                    ]
                );
            }
        }
        $calendar_details=Calendar::addEvents($events_List)->setOptions([
            'defaultView'=>'month',
            'selectable'=>'true',
            'businessHours'=>'true',
            'allDay'=>'false',
            'locale'=>'fr'
        ])->setCallbacks([
            'dayClick'=> "function(date) {
            $('#myModal').modal();
            var date1=date.format();
            $('#date').val(date1);
            return false
                }"]);
        return view('events',compact('calendar_details'));
    }
    public function addEvent(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'event_name'=>'required',
            'start_date'=>'required',
            'end_date'=>'required'
        ]);
        if ($validator->fails()){
            \Session::flash('warning','please enter the valid details');
            return Redirect::to('/events')->withInput()->withErrors($validator);

        }
        $event=new Events;
        $event->events_name=$request['event_name'];
        $event->start_date =$request['start_date'];
        $event->end_date=$request['end_date'];
        $event->save();
        \Session::flash('success','Event added successfully');
        return Redirect::to('/events');

    }
}
