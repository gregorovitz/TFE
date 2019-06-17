<?php

namespace App\Http\Controllers;
use App\DataTables\EventDataTable;
use App\Notifications\RentalRequestLocalManager;
use App\Notifications\RentalRequest;
use App\Room;
use App\Http\Requests\storeEventRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Events;
use Illuminate\Support\Facades\Auth;
use App\Booking;
use App\Organisation;
use App\Notifications\RentalRequestTrésorier;
class EventController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:list-event',['only'=>['index']]);
        $this->middleware('permission:show-event', ['only' => ['show']]);
        $this->middleware('permission:create-event', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-event', ['only' => ['edit', 'update']]);
        $this->middleware('permission:validate-event', ['only' => ['validateEvent']]);
        $this->middleware('permission:payment-validation-event',['only'=>['payementvalidateEvent']]);
    }
    public function index(EventDataTable $dataTable){
        return $dataTable->render('events.view');
    }
    public function show($id){
        $eventHasBooking = booking::where('eventId', $id)
            ->count();
        $event=Events::findOrFail($id);
        return view('events.show', compact('event' ,'eventHasBooking'));
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

//        $nameBooking=Auth::user()->name.Auth::user()->firstname.date('d/m/Y-G:i:s').$request['event_name'];
//        $booking=new Booking;
//        $booking->name=$nameBooking;
//        $booking->userId=Auth::user()->id;
//        $booking->save();
//        $bookingIds=Booking::where('name','=',$nameBooking)->select('id')->get();
//        $bookingid=$bookingIds[0]->id;
        //        echo($nameBooking);die();
        $event=new Events;
//        $event->validate=0;
//        $event->payement=0;
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
//        $event->booking()->sync($bookingid);
//        $event->type()->sync($request['typeEventsId']);

        \Session::flash('success','Event added successfully');
        $userNotify=User::find($event->userId);
        $userNotify->notify(new RentalRequest($event));
        $users=DB::select('call get_user_has_Role(\'gestionnaire de salle\')');

        foreach ($users as $user){
            $managerNotify=User::find($user->id);

            $managerNotify->notify(new RentalRequestLocalManager($event,$userNotify));

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
    public function validateEvent(Request $request,$id)
    {


        $event = Events::find($id);
        if ($event->color == 'yellow') {
            $event->color = 'orange';
//        }elseif($event->color=='blue') {
//            $event->color='dark_green';
        }
        $event->updated_at = now();
        $event->save();
        $bookingid=Booking::where('eventId',$id)
            ->update(['communication'=>$request['communication'],'validate'=>1]);


        $booking=Booking::findOrFail($bookingid);

        $users=DB::select('call get_user_has_Role(\'trésorier\')');

        foreach ($users as $user){
            $managerNotify=User::find($user->id);

            $managerNotify->notify(new RentalRequestTrésorier($event,$booking));

        }
        return redirect()->to('/location/' . $event->roomId)
            ->with('success', __('messages.user.update'));
    }
    public function payementvalidateEvent($id)
    {
        Booking::where('eventId',$id)
            ->update(['payement'=>1]);

        $event = Events::find($id);
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


