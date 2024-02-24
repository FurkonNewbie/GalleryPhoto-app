<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserManagementProcedures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE PROCEDURE CountUsersByRole()
        BEGIN
            SELECT
                COUNT(CASE WHEN role = "admin" THEN 1 END) AS admin_count,
                COUNT(CASE WHEN role = "user" THEN 1 END) AS user_count
            FROM users;
        END
    ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS CountUsersByRole;');
    }
}
