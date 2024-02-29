<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('like', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('foto_id');
            $table->timestamps();
        });
        // TRIGGER REKAP INSERT LIKE
//         DB::unprepared('
//              CREATE TRIGGER trigger_like_insert
//              AFTER INSERT ON `like`
//              FOR EACH ROW
//              BEGIN
//                  INSERT INTO log_like (user_id, action, created_at, updated_at)
//                  VALUES (NEW.id, "INSERT", "", NOW(), NOW());
//              END;
//          ');
//         //TRIGGER REKAP DELETE LIKE
//         DB::unprepared('
//        CREATE TRIGGER trigger_like_delete
//        AFTER DELETE ON `like`
//        FOR EACH ROW
//        BEGIN
//            INSERT INTO log_like (user_id, action,created_at, updated_at)
//            VALUES (OLD.id, "DELETE", "", NOW(), NOW());
//        END;
// ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('like');
    }
}
