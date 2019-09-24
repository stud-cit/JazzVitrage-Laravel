<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('evaluations_id');
            $table->integer('user_id')->unsigned();
            $table->integer('application_id')->unsigned();
            $table->tinyInteger('stylistic_matching')->default(0);
            $table->tinyInteger('artistic_value')->default(0);
            $table->tinyInteger('artistry')->default(0);
            $table->tinyInteger('originality')->default(0);
            $table->tinyInteger('evaluation')->default(0);
            $table->timestamps();
        });

        Schema::table('evaluations', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('application_id');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('application_id')->references('application_id')->on('application');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluations');
    }
}
