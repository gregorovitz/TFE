<?php

namespace App\Http\Controllers;
use App\EventIntern;
use App\Partenaire;
use App\Room;
use App\Secteur;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
use App\Events;
use App\Http\Requests\StoreEventInterneRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;


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
            return Redirect::to('/location/'.$request['roomsId'])->withInput();;
        }

        $event=new Events;
        $event->name=$request['event_name'];
        $event->numPeopleExp=$request['people'];
        $event->start_date =$request['start_date'];
        $event->end_date=$request['end_date'];
        $event->startime=$request['start_time'];
        $event->endtime=$request['end_time'];
        $event->roomId=$request{'roomsId'};
        $event->userId=Auth::user()->id;
        $event->url='eventInterne';
        $event->color="blue";
        $event->save();

        $interne=new EventIntern;
        $interne->programme=$request['program'];
        $interne->evaluation=$request['eval'];
        $interne->age=$request['age'];
        $interne->participant=$request['participant'];
        $interne->budget=$request['budget'];
        $interne->secteurId=$request['secteur'];
        $interne->eventId=$event->id;
        $interne->save();

        \Session::flash('success','Event added successfully');
        return Redirect::to('/location/'.$request{'roomsId'});

    }
    public function create($date,$hour,$room){
        echo 'ocuocu';
        $partenaire=Partenaire::pluck('name','id');
        if (!empty($partenaire)){print_r ($partenaire);};echo ('1');
        $dataroom=Room::findOrFail($room);
        print_r($dataroom);echo('2');
        $secteur=Secteur::pluck('name','id');
        print_r($secteur);echo('3');die();

        return view('eventInterne.create',compact('secteur','partenaire','date','hour','dataroom'));
    }
   /* public function edit($id)
    {
        $event = Events::find($id);
        return view();
    }*/
    public function index(){
        return view('eventInterne.view');
    }

    public function anyColumnSearchData(){

        return DataTables::of(EventIntern::query())
            //permet l'ajout de class pour chaque ligne du dataTable
            // si paire rajoute text-succes (text en vert) si impaire rajoute text-danger (text en rouge)
            ->setRowClass(function($interne){
                return $interne->id %2==0?'text-success':'text-danger';
            })
            //permet l'ajout d'un id pour chaque ligne
            //rajoute comme id l'id de la permission
            ->setRowId (function($interne){
                return $interne->id;
            })
            //permet d'ajoutté un attribu a chaque ligne du dataTable
            // align le text  au centre dans les lignes du da tatable
            ->setRowAttr(['align'=>'center'])
            // permet l'ajout d'une column
            //rajouter function closure si recup donné d'une autre column
            ->addColumn('room', function(EventIntern $interne){
                return $interne->event->room->name;
            })
            ->addColumn('date',function(EventIntern $interne){
                return $interne->event->start_date.' '.$interne->event->startime.' - '.$interne->event->end_date.' '.$interne->event->endtime ;
            })

            //permet d'editer une column pour par exemple rajouter du texte
            //ou de modifier les données par exemple afficher depuis quand a la place d'afficher la date
            ->editColumn('budget',function(EventIntern $interne){
                return $interne->budget.' €';
            })
            ->editColumn('created_at',function(EventIntern $interne){
                return $interne->created_at->diffForHumans();
            })

            //modifier et use rawColumns pour appliquer le blade afin de ne pas afficher l'html
            ->editColumn('updated_at','column')
            ->rawColumns(['updated_at'])

            // permet de retirer une column
            ->removeColumn('updated_at')
            ->make(true);
        }

}

