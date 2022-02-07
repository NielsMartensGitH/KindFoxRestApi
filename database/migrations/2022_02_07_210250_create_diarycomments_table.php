<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiarycommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diarycomments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->text('comment');
            $table->integer('diary_id', false, true);
            $table->integer('parent_id', false, true);
            $table->integer('daycare_id', false, true);
            $table->foreign('diary_id')->references('id')->on('diaries')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('parents')->onDelete('cascade');
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
        Schema::dropIfExists('diarycomments');
    }
}
