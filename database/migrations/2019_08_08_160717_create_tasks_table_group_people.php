<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTableGroupPeople extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function down()
    {
        
    }
    public function up()
    {
        Schema::dropIfExists('group_people');
        
        Schema::create('group_people', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('group_people_id');
            $table->integer('application_id')->unsigned();
            $table->index('application_id');
            $table->string('name', 50);
            $table->integer('count_people');
            $table->integer('average_age');
            $table->string('file', 50);
            $table->timestamps();
        });
        
        Schema::table('group_people', function (Blueprint $table) {
            
            $table->foreign('application_id')->references('application_id')->on('application')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    
}
