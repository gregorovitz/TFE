<?php

namespace App\Http\Controllers;
use App\EventIntern;
use App\Partenaire;
use App\Room;
use App\Secteur;
use Illuminate\Support\Facades\DB;
use App\Events;
use App\Http\Requests\StoreEventInterneRequest;



class EventInterneController extends Controller
{
    public function show($id){

        return view('eventInterne.show', ['eventInterne' => EventIntern::findOrFail($id)]);
    }
    public function store(StoreEventInterneRequest $request)
    {
        $start=$request['start_date'].' '.$request['start_time'];
        $end=$request['end_date'].' '.$request['end_time'];

        $plagehoraireoccuper=DB::select('call isdispo("'.$start.'","'.$end.'",'.$request{'roomsId'}.')');
        if ($plagehoraireoccuper ==null){

        }
        else {
            \Session::flash('warning','this time slot is already occupied');
            return Redirect::to('/location/'.$request['roomsId'])->withInput();
            ;

        }

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
        \Session::flash('success','Event added successfully');
        return Redirect::to('/location/'.$request{'roomsId'});

    }
    public function create($date,$hour,$room){
        $partenaire=Partenaire::pluck('name','id');
        $dataroom=Room::findOrFail($room);
        $secteur=Secteur::pluck('name','id');

        return view('eventInterne.create',compact('secteur','partenaire','date','hour','dataroom'));
    }
    public function edit($id)
    {
        $event = Events::find($id);



        return view();
    }


}

