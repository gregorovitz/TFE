<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Events;
class EventController extends Controller
{
    public function show($id){

        return view('events.view', ['event' => Events::findOrFail($id)]);
    }
    public function store(Request $request)
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
    public function edit($id)
    {
        $event = Events::find($id);



        return view();
    }
    
}
