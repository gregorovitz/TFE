<?php

namespace App\Http\Controllers;
use App\Room;
use App\TypeEvents;
use App\Http\Requests\storeEventRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Events;
use Illuminate\Support\Facades\Auth;
use App\Booking;
use Yajra\DataTables\DataTables;
class EventController extends Controller
{
    public function index(){
        return view('events.view');
    }
    public function anyData(){
        return DataTables::of(Events::query())->make(true);
    }

    public function show($id){

        return view('events.show', ['event' => Events::findOrFail($id)]);
    }
    public function store(storeEventRequest $request)
    {
        $start=$request['start_date'].' '.$request['start_time'];
        $end=$request['end_date'].' '.$request['end_time'];

        $plagehoraireoccuper=DB::select('call isdispo("'.$start.'","'.$end.'",'.$request{'roomsId'}.')');
        if ($plagehoraireoccuper ==null){

        }
        else {
            \Session::flash('warning','this time slot is already occupied');
            return Redirect::to('/location/'.$request['roomsId'])->withInput();

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
        $event->userId=Auth::user()->id;
        $event->url='event';
        $event->save();
        $event->booking()->sync($bookingid);
        $event->type()->sync($request['typeEventsId']);
        \Session::flash('success','Event added successfully');
        return Redirect::to('/location/'.$request{'roomsId'});

    }
    public function create($date,$hour,$room){
        $typesEvents=TypeEvents::pluck('name','id');
        $dataroom=Room::findOrFail($room);

        return view('events.create',compact('typesEvents','date','hour','dataroom'));
    }
    public function edit($id)
    {
        $event = Events::find($id);



        return view();
    }

}
