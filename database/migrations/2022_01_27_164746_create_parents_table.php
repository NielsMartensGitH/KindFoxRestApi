<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentsTable extends Migration
{
    /**
     * Run the migrations.
    //  *
    //  * @return void
    //  */
    public function up()
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('login');
            $table->string('password');
            $table->integer('daycare_id', false, true);
            $table->string('phone');
            $table->foreign('daycare_id')->references('id')->on('daycares')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
    //  * @return void
    //  */
    public function down()
    {
        Schema::dropIfExists('parents');
    }
}
