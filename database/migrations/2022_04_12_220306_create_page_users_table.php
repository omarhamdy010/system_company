<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageUsersTable extends Migration
{

    public function up()
    {
        Schema::create('page_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('email');
            $table->string('phone');
            $table->text('presence_time');
            $table->text('absence_time');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('page_users');
    }
}
