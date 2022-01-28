<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
    //  * @return void
    //  */
    public function up()
    {
        Schema::create('children', function (Blueprint $table) {
            $table->increments('id');
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
        Schema::dropIfExists('children');
    }
}
