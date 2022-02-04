<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaycaresTable extends Migration
{


    /**
     * Run the migrations.
     *
    //  * @return void
    //  */
    public function up()
    {
        Schema::create('daycares', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('street');
            $table->string('country');
            $table->string('city');
            $table->string('postal_code');
            $table->string('btw_number');
            $table->string('phone');
            $table->string('avatar');

        });
    }

    /**
     * Reverse the migrations.
     *
    //  * @return void
    //  */
    public function down()
    {
        Schema::dropIfExists('daycares');
    }
}
