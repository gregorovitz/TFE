<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureGetuserhasRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("CREATE PROCEDURE get_user_has_Role(in nameRole varchar(255))
BEGIN
SELECT *
FROM users
where id in
    (
        select model_id 
        from model_has_roles 
        where role_id in
    (
        select id 
            from roles
			where name=nameRole                 
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
        DB::unprepared('DROP PROCEDURE IF EXISTS get_user_has_Role;');
    }
}
