<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Menyimpan ID dari user yang terkait
            $table->string('action'); // Menyimpan informasi tindakan (INSERT, UPDATE, DELETE)
            $table->string('username');
            $table->string('email');
            $table->string('alamat');
            $table->string('no_telepon', 12)->nullable();
            $table->text('keterangan')->nullable(); // Menyimpan keterangan tambahan jika diperlukan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_users');
    }
}
