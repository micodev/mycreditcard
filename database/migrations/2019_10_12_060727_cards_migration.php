<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CardsMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * 
     * "id INTEGER PRIMARY KEY autoincrement,"
     *   "cardNumber TEXT NOT NULL, "
     *   "typeId INTEGER NOT NULL "
     */
    public function up()
    {
       Schema::create('cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text("cardNumber");
            $table->bigInteger("type_id");
         });
    }

    /*
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
