<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('bio')->nullable();
            $table->string('no_telepon', 12)->nullable();
            $table->string('alamat')->nullable()->default('');
            // $table->string('url')->nullable();
            $table->string('profile')->nullable();
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->rememberToken();
            $table->timestamps();
        });


        DB::unprepared('
        CREATE TRIGGER trigger_user_insert
        AFTER INSERT ON users
        FOR EACH ROW
        BEGIN
            DECLARE alamat_value VARCHAR(255);

            -- Set alamat_value ke nilai alamat dari NEW atau kosongkan jika NULL
            SET alamat_value = COALESCE(NEW.alamat, "");

            INSERT INTO log_users (user_id, action, username, email, alamat, no_telepon, keterangan, created_at, updated_at)
            VALUES (NEW.id, "INSERT", NEW.username, NEW.email, alamat_value, NEW.no_telepon, "", NOW(), NOW());
        END;
    ');
        DB::unprepared('
    CREATE TRIGGER trigger_user_update
    AFTER UPDATE ON users
    FOR EACH ROW
    BEGIN
        INSERT INTO log_users (user_id, action, username, email, alamat, no_telepon, keterangan, created_at, updated_at)
        VALUES (NEW.id, "UPDATE", NEW.username, NEW.email, NEW.alamat, NEW.no_telepon, "", NOW(), NOW());
    END;
');

        DB::unprepared('
    CREATE TRIGGER trigger_user_delete
    AFTER DELETE ON users
    FOR EACH ROW
    BEGIN
        INSERT INTO log_users (user_id, action, username, email, alamat, no_telepon, keterangan, created_at, updated_at)
        VALUES (OLD.id, "DELETE", OLD.username, OLD.email, OLD.alamat, OLD.no_telepon, "", NOW(), NOW());
    END;
');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
