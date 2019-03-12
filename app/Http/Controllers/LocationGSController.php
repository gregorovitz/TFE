<?php

namespace App\Http\Controllers;

use App\Booking;
use App\TypeEvents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Events;
class LocationGSController extends Controller
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
                if ($event->interneId==null){
                    $color=$event->color;
                }else{
                    $color='red';
                }
                $nameOrg=$event->user->organisation->name;
                $events_List[]=Calendar::event(

                    $event->name,
                    false,
                    new \DateTime($event->start_date.$event->startime),
                    new \DateTime($event->end_date.$event->endtime),
                    null,
                    // Add color and link on event

                    [

                        'name'=>$event->user->name,
                        'firstname'=>$event->user->firstname,
                        'organisation'=>$nameOrg,
                        'address'=>$event->user->street.' '.$event->user->streetNum,
                        'zip'=>$event->user->city->zipCode,
                        'city'=>$event->user->city->name,
                        'color' => $color,
                        'phone'=>$event->user->phone,
                        'type'=>$event->type->name,
                        'mail'=>$event->user->email,
                        'exp'=>$event->numPeopleExp,
                        'id'=>$event->id

//                        'url' => '/event/{'.$event->id.'}' ,
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
//            'eventClick'=>" function(calEvent) {
//                $('#Modalview).modal();
//                $('#title').val(calEvent.title);
//                $('#start_event').val(calEvent.start.format('DD-MM-YYYY HH:MM:SS'));
//                $('#end_event').val( calEvent.end.format('DD-MM-YYYY HH:MM:SS'));
////                alertnombre de personne attendue: '+calEvent.exp );
//                // change the border color just for fun
//                 $(this).css('border-color', 'red');
//            }"
            'eventClick'=>"function (calEvent){
            $('#Modalview').modal();
            $('#title').text(calEvent.title);
            $('#name').text(calEvent.name);
            $('#firstname').text(calEvent.firstname);
            $('#organisation').text(calEvent.organisation);
            $('#address').text(calEvent.address);
            $('#zip').text(calEvent.zip);
            $('#city').text(calEvent.city);
            $('#phone').text(calEvent.phone);
            $('#mail').text(calEvent.mail);
            $('#start_date').html(calEvent.start.format('DD-MM-YYYY HH:MM:SS'));
            $('#end_date').html(calEvent.end.format('DD-MM-YYYY HH:MM:SS'));
            $('#type').text(calEvent.type);
            $('#peopleExp').text(calEvent.exp);
            $('#print').attr('href','/print/'+calEvent.id)
            return false;
                }"
        ]);

        return view('calendar.calendar',compact('calendar_details','typesEvents'));
    }
    public function addEvent(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'event_name'=>'required',
            'start_date'=>'required|date|after:today',
            'start_time'=>'required|date_format:H:i|after_or_equal:09:00|before_or_equal:24:00',
            'end_time'=>'required|date_format:H:i|before_or_equal:24:00|after_or_equal:09:00',
            'end_date'=>'required|date|after_or_equal:start_date',
            'typeEventsId'=>'required|integer|exists:typeevents,id',
            'numPeopleexp'=>'required|integer',
            'roomsId'=>'required|integer'

        ]);
        if ($validator->fails()){
            \Session::flash('warning','please enter the valid details');
            return Redirect::to('/location/'.$request{'roomsId'})->withInput()->withErrors($validator);

        }
       $start=$request['start_date'].' '.$request['start_time'];
        $end=$request['end_date'].' '.$request['end_time'];

        $plagehoraireoccuper=DB::select('call isdispo("'.$start.'","'.$end.'",'.$request{'roomsId'}.')');
        if ($plagehoraireoccuper ==null){

        }
        else {
            \Session::flash('warning','this time slot is already occupied');
            return Redirect::to('/location/'.$request['roomsId'])->withInput()->withErrors($validator);

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
        return Redirect::to('/location/'.$request{'roomsId'});

    }
}
