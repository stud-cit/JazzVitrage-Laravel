<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksApplication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('application_id');
            $table->integer('nomination_id')->unsigned();
            $table->integer('application_type_id')->unsigned();
            $table->string('status', 20);
            $table->timestamps();
        });

        Schema::table('application', function (Blueprint $table) {
            $table->index('nomination_id');
            $table->index('application_type_id');
            $table->foreign('nomination_id')->references('nomination_id')->on('nomination');
            $table->foreign('application_type_id')->references('application_type_id')->on('application_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('application');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
