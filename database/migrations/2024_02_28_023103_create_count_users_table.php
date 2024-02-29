<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('count_users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        DB::unprepared('
        CREATE FUNCTION CountUsers() RETURNS INT
        BEGIN
            DECLARE user_count INT;
            SELECT COUNT(*) INTO user_count FROM users;
            RETURN user_count;
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
        Schema::dropIfExists('count_users');

        // Rollback pernyataan SQL untuk fungsi atau prosedur
        DB::unprepared('DROP FUNCTION IF EXISTS CountUsers');
    }
}
