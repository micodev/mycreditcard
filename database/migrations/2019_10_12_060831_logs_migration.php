<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LogsMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * "(id integer NOT NULL primary key autoincrement,"
    *  "userId integer NOT NULL ,"
     *   "amount REAL NOT NULL ,"
      *  "label TEXT NOT NULL,"
       * "date INTEGER NOT NULL)"
     */
    public function up()
    {
          Schema::create('logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("user_id");
            $table->double('amount', 8, 2);
            $table->text("label");
            $table->bigInteger("date");
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('logs');
    }
}
