<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CompanysMigration extends Migration
{
    /**
     * Run the migrations.
     *
     *  "id integer NOT NULL primary key autoincrement,"
     *  "name TEXT NOT NULL)"
     */
    public function up()
    {
          Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text("name");
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
