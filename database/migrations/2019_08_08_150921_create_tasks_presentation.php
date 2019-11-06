<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksPresentation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presentation', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('presentation_id');
            $table->string('composition_one', 50);
            $table->string('author_one', 50);
            $table->string('time_one', 50);
            $table->string('composition_two', 50);
            $table->string('author_two', 50);
            $table->string('time_two', 50);
            $table->string('video');
            $table->integer('application_id')->unsigned();
            $table->timestamps();
        });
        
        Schema::table('presentation', function (Blueprint $table) {
            $table->index('application_id');
            $table->foreign('application_id')->references('application_id')->on('application')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presentation');
    }
}
