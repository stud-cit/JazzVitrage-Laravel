<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('teacher_id');
            $table->string('teacher_name');
            $table->string('teacher_surname');
            $table->string('teacher_patronymic');
            $table->string('teacher_in');
            $table->string('teacher_email');
            $table->string('teacher_phone');
            $table->string('teacher_passport_data');
            $table->string('teacher_passport');
            $table->string('teacher_address');
            $table->integer('application_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('teachers', function (Blueprint $table) {
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
        Schema::dropIfExists('teachers');
    }
}
