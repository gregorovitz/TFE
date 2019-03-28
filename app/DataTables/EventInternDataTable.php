<?php

namespace App\DataTables;

use App\EventIntern;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\DB;

class EventInternDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->rawColumns(['evaluation','participant','programme','budget'])
            ->setRowAttr(['align'=>'center'])
            ->setRowClass(function($query){
                return $query->id %2==0?'text-success':'text-danger';
            })


            ;
        /*->addColumn('room', function(EventIntern $interne){
        return $interne->event->room->name;});*/
           /*

            })
            ->addColumn('date', function(EventIntern $interne){
                return $interne->event->start_date.' '.$interne->event->startime.' - '.$interne->event->end_date.' '.$interne->event->endtime;
            });*/
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\EventIntern $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
   /* public function query(EventIntern $model)
    {
        return $model->newQuery()->select('id','programme','age','participant','budget','evaluation', 'created_at', 'updated_at');
    }*/
   public function query (){
      return DB::table('eventintern')
           ->select('eventintern.id',
               DB::raw('concat(\'<a href="\',eventintern.programme,\'">programme</a>\')as programme '),
               DB::raw('concat(\'<a href="\',eventintern.evaluation,\'">evaluation</a>\')as evaluation '),
               DB::raw('concat(\'<a href="\',eventintern.participant,\'">participant</a>\')as participant '),
               DB::raw('concat(eventintern.budget," €")as budget'),
               'eventintern.age',
               'events.numPeopleExp as nbParticipant',
               'rooms.name as room',
               DB::raw('concat(events.start_date," ",events.startime," - ",events.end_date," ",events.endtime ) as date'),
//               DB::raw('CONCAT(users.firstname," ",users.name)as responsable'))
                'users.firstname',
                'users.name'
           )
          ->join('events','eventintern.eventId','=','events.id')
          ->join('users','events.userId','=','users.id')
          ->join('rooms','events.roomId','=','rooms.id');
   }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $interne=EventIntern::all();
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
//
                    ->parameters([
                        'initComplete'=>"function(){
                            this.api().columns().every(function(){
                                var column=this;
                                var input=document.createElement(\"input\");
                                $(input).appendTo($(column.footer()).empty())
                                .on ('change',function(){
                                column.search($(this).val(),false,false,true).draw();
                                columns.adjust().draw();
                                });
                            });
                        }",

                        'scrollX'=>'true'
//                        'autoWidth'=>true

                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
        ['data'=>'id',"name"=>'id','title'=>'id', "width"=>'5%'],
            'programme',
            'budget',
            'evaluation',
            'age',
            'participant',
            'nbParticipant',
            ['data'=>'room','name'=>'rooms.name','title'=>'room'],
            'responsable',
            'date'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'EventIntern_' . date('YmdHis');
    }
}
