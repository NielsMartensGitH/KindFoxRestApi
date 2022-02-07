<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diaries', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('child_id', false, true);
            $table->integer('type_id', false, true);
            $table->text('food');
            $table->text('foodSmile');
            $table->text('sleep');
            $table->text('sleepSmile');
            $table->text('poop');
            $table->text('mood');
            $table->text('activities');
            $table->text('involvement');
            $table->text('extra_message');
            $table->integer('privacy');
            $table->integer('daycare_id', false, true);
            $table->foreign('child_id')->references('id')->on('childrens')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
            $table->foreign('daycare_id')->references('id')->on('daycares')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diaries');
    }
}
