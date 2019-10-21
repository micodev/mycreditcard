<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        
        "(id integer NOT NULL primary key autoincrement ,"
        "name TEXT NOT NULL ,"
        "number TEXT NOT NULL ,"
        "balance REAL NOT NULL DEFAULT '0')

        */
         Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text("username")->nullable();
            $table->text("name");
            $table->text("number");
            $table->double("balance",9,2);
         });
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
