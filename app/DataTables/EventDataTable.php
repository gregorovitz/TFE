<?php

namespace App\DataTables;

use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\DB;

class EventDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    protected $exportColumns = [
        'id',
        'numPeopleExp',
        'name',
        'start_date',
        'end_date',
        'startime',
        'endtime',
        'Namerooms',
        'organisation',
        'locataire',
        'validate',
        'commentaire',
        'created_at',
        'updated_at',
    ];
    public function dataTable($query)
    {
        return datatables($query)
            ->setRowAttr(['align'=>'center'])
            ->addColumn('action', 'eventdatatable.action')
            ->filterColumn('Namerooms', function($query, $keyword) {
                 $sql = "rooms.name like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('organisation', function($query, $keyword) {
                $sql = "organisations.name like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('locataire',function($query,$keyword){
                $sql="CONCAT(users.firstname,' ',users.name) like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
    });

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Events $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return DB::table('events')
            ->join('users','events.userId','=','users.id')
            ->join('rooms','events.roomId','=','rooms.id')
            ->join('organisations','events.organisationId','=','organisations.id')
            ->select(['events.id',
        'events.numPeopleExp',
        'events.name',
        'events.start_date',
        'events.end_date',
        'events.startime',
        'events.endtime',
        'rooms.name as Namerooms',
        'organisations.name as organisation',
         DB::raw("CONCAT(users.firstname,' ',users.name) as locataire"),
        'events.validate',
        'events.commentaire',
        'events.created_at',
        'events.updated_at']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addAction(['width' => '80px'])
                    ->parameters([
                        'initComplete'=>"function(){
                            this.api().columns().every(function(){
                                var column=this;
                                var input=document.createElement(\"input\");
                                $(input).appendTo($(column.footer()).empty())
                                .on ('change',function(){
                                column.search($(this).val(),false,false,true).draw();
                               });
                            });
                        }",

                        'scrollX'=>'true',
                        'dom'=>'Bfrtip',
                        'buttons'=>['excel']
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

            'id',
            'numPeopleExp',
            'name',
            'start_date',
            'end_date',
            'startime',
            'endtime',
            'Namerooms',
            'organisation',
            'locataire',
            'validate',
            'commentaire',
            'created_at',
            'updated_at',

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Event_' . date('YmdHis');
    }
}
