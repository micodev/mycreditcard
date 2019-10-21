<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TypesMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
            "(id integer NOT NULL primary key autoincrement,"
            "brandPrice REAL NOT NULL,"
            "price REAL NOT NULL,"
            "companyId integer NOT NULL)"
        */
        Schema::create('types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double("brandPrice",9,2);
            $table->double("price",9,2);
            $table->bigInteger("company_id");
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('types');
    }
}
