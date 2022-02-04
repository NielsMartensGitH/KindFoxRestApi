<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildrensTable extends Migration
{
    /**
     * Run the migrations.
     *
    //  * @return void
    //  */
    public function up()
    {
        Schema::create('childrens', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('child_firstname');
            $table->string('child_lastname');
            $table->string('age');
            $table->string('childcode');
        });
    }

    /**
     * Reverse the migrations.
     *
    //  * @return void
    //  */
    public function down()
    {
        Schema::dropIfExists('childrens');
    }
}
