<?php

namespace App\Http\Controllers;

use App\Booking;
use App\TypeEvents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Events;
class LocationGSController extends Controller
{
    public function index(){
        $typesEvents=TypeEvents::pluck('name','id');

        $events=Events::get();
        $events_List=[];
        if ($events->count()){
            foreach ($events as $key =>$event){
//                print_r($event) ;
                $events_List[]=Calendar::event(

                    $event->name,
                    false,
                    new \DateTime($event->start_date.$event->startime),
                    new \DateTime($event->end_date.$event->endtime),
                    null,
                    // Add color and link on event
                    [

                        'color' => $event->color,
//                        'url' => '/event/{'.$event->id.'}' ,
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
            
            $('#start').val(date1);
            $('#end').val(date1);
            return false
                }",
            'eventClick'=>" function(calEvent, jsEvent, view) {
                alert('date début: ' + calEvent.start.format('DD-MM-YYYY HH:MM:SS')+ '\\ndate de fin: '+ calEvent.end.format('DD-MM-YYYY HH:MM:SS')+'\\nnom : '+ calEvent.title);
                // change the border color just for fun
                 $(this).css('border-color', 'red');
            }"
//            'eventClick'=>"function (calEvent){
//            $('#myModalEvent').modal();
//        var date_start=calEvent.start;
//        var date_end=calEvent.end;
//        $('#title').val(calEvent.title);
//        $('#start_event').val(date_start);
//        $('#end_event').val(date_end);
//        return false;
//                }"
        ]);

        return view('calendar.calendar',compact('calendar_details','typesEvents'));
    }
    public function addEvent(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'event_name'=>'required',
            'start_date'=>'required|date|after:today',
            'start_time'=>'required',
            'end_time'=>'required',
            'end_date'=>'required|date|after_or_equal:start_date',
            'typeEventsId'=>'required|integer|exists:typeevents,id',
            'numPeopleexp'=>'required|integer',
            'roomsId'=>'required|integer'

        ]);
        if ($validator->fails()){
            \Session::flash('warning','please enter the valid details');
            return Redirect::to('/location')->withInput()->withErrors($validator);

        }

        $nameBooking=Auth::user()->name.Auth::user()->firstname.date('d/m/Y-G:i:s').$request['event_name'];
        $booking=new Booking;
        $booking->name=$nameBooking;
        $booking->userId=Auth::user()->id;
        $booking->save();
        $bookingIds=Booking::where('name','=',$nameBooking)->select('id')->get();
        $bookingid=$bookingIds[0]->id;
        //        echo($nameBooking);die();
        $event=new Events;
        $event->name=$request['event_name'];
        $event->numPeopleExp=$request['numPeopleexp'];
        $event->start_date =$request['start_date'];
        $event->end_date=$request['end_date'];
        $event->startime=$request['start_time'];
        $event->endtime=$request['end_time'];
        $event->roomId=$request{'roomsId'};
        $event->typeEventsId=$request['typeEventsId'];
        $event->userId=Auth::user()->id;
        $event->bookingId=$bookingid;
        $event->save();
        \Session::flash('success','Event added successfully');
        return Redirect::to('/location');

    }
}
