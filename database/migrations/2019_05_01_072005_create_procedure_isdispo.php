<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureIsdispo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE  PROCEDURE isdispo(in start datetime,end datetime,room int)
BEGIN
select id from events 
	where(
			(
				(
					(STR_TO_DATE(start,"%Y-%m-%d %H:%i:%s")< addtime(start_date,startime))
					and
					(STR_TO_DATE(end,"%Y-%m-%d %H:%i:%s")> addtime(start_date,startime))
				)
				or 
                (
					(STR_TO_DATE(start,"%Y-%m-%d %H:%i:%s")>addtime(start_date,startime)) 
                    and
					(STR_TO_DATE(start,"%Y-%m-%d %H:%i:%s")<addtime(end_date,endtime)) 
                )   
                or
				(
					(STR_TO_DATE(end,"%Y-%m-%d %H:%i:%s")<addtime(end_date,endtime)) 
                    and
					(STR_TO_DATE(end,"%Y-%m-%d %H:%i:%s")>addtime(start_date,startime)) 
                )
                or 
                (STR_TO_DATE(end,"%Y-%m-%d %H:%i:%s")=addtime(end_date,endtime))
                or(STR_TO_DATE(start,"%Y-%m-%d %H:%i:%s")=addtime(start_date,startime))
			)
            and 
            (roomId=room)
            and
            (validate=1)
       );

END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS isdispo;');
    }
}
