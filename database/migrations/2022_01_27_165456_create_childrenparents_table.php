<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildrenparentsTable extends Migration
{
    /**
     * Run the migrations.
     *
    //  * @return void
    //  */
    public function up()
    {
        Schema::create('childrenparents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('child_id', false, true);
            $table->integer('parent_id', false, true);
            $table->foreign('child_id')->references('id')->on('children')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('parents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
    //  * @return void
    //  */
    public function down()
    {
        Schema::dropIfExists('childrenparents');
    }
}
