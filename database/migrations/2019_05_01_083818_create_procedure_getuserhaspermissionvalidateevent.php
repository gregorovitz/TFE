<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureGetuserhaspermissionvalidateevent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("CREATE PROCEDURE get_user_has_pemission_validate_event()
BEGIN
SELECT *
FROM users
where id in
    (
        select model_id 
        from model_has_roles 
        where role_id in
    (
        select role_id 
            from role_has_Permissions 
            where permission_id in
    (
        select id 
                from permissions 
                where name='validate-event'
                ) 
			)
		);
END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS get_user_has_pemission_validate_event;');
    }
}
