<?php

namespace App\Http\Controllers;
use App\Notifications\RentalRequest;
use App\Room;
use App\Http\Requests\storeEventRequest;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Events;
use Illuminate\Support\Facades\Auth;
use App\Booking;
use App\Organisation;
class EventController extends Controller
{
   /* public function index(){
        return view('events.view');
    }
    public function anyData(){
        return DataTables::of(Events::query())->make(true);
    }*/
    public function __construct()
    {
       $this->middleware('auth');
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
            return Redirect::to('/event/'.$request['start_date'].'/'.$request['start_time'].'/'.$request['roomsId'].'/location')->withInput();

        }
        $typepeople='';
        switch ($request['typepeople']){
            case 0:
                $typepeople='privé';
                break;
            case 1:
                $typepeople='public';
                break;
            case 2:
                $typepeople=$request['otherTypePeople'];
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
        $event->validate=0;
        $event->payement=0;
        $event->name=$request['event_name'];
        $event->numPeopleExp=$request['numPeopleexp'];
        $event->start_date =$request['start_date'];
        $event->end_date=$request['end_date'];
        $event->startime=$request['start_time'];
        $event->endtime=$request['end_time'];
        $event->roomId=$request['roomsId'];
        $event->userId=Auth::user()->id;
        $event->url='event';
        $event->publicTypes=$typepeople;
        $event->description=$request['descriptionEvents'];
        $event->organisationId=$request['organisationId'];
        $event->commentaire=$request['comment'];
        $event->save();
        $event->booking()->sync($bookingid);
//        $event->type()->sync($request['typeEventsId']);

        \Session::flash('success','Event added successfully');
        $users=DB::select('call get_user_has_pemission_validate_event()');
        foreach ($users as $user){
            $userNotify=User::find($user->id);

            $userNotify->notify(new RentalRequest($event));
        }

        return Redirect::to('/location/'.$request{'roomsId'});

    }
    public function create($date,$hour,$room){
//        $typesEvents=TypeEvents::pluck('name','id');
        $dataroom=Room::findOrFail($room);
        $organisation=Organisation::pluck('name','id');
        return view('events.create',compact('date','hour','dataroom','organisation'));
    }
    public function edit($id)
    {
        $event = Events::find($id);



        return view();
    }
    public function validateEvent($id)
    {
        $event = Events::find($id);
        $event->validate = 1;
        if ($event->color == 'yellow') {
            $event->color = 'orange';
//        }elseif($event->color=='blue') {
//            $event->color='dark_green';
        }
        $event->updated_at = now();
        $event->save();

        return redirect()->to('/location/' . $event->roomId)
            ->with('success', __('messages.user.update'));
    }
    public function payementvalidateEvent($id)
    {
        $event = Events::find($id);
        $event->payement = 1;
        $event->color = 'green';
//        }elseif($event->color=='blue') {
//            $event->color='dark_green';
//        }
        $event->updated_at = now();
        $event->save();

        return redirect()->to('/location/' . $event->roomId)
            ->with('success', __('messages.user.update'));
    }
}


