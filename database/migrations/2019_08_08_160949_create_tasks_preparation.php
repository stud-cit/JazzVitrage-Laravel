<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksPreparation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preparation', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('preparation_id');
            $table->string('school_one', 50);
            $table->string('school_address', 50);
            $table->string('school_email', 50);
            $table->string('school_phone', 50);
            $table->string('teacher_name', 50);
            $table->string('teacher_surname', 50);
            $table->string('teacher_patronomic', 50);
            $table->string('teacher_in', 50);
            $table->string('teacher_email', 50);
            $table->string('teacher_phone', 50);
            $table->integer('is_concertmaster');
            $table->string('concertmaster_name', 50);
            $table->string('concertmaster_surname', 50);
            $table->string('concertmaster_patronomic', 50);
            $table->integer('application_id')->unsigned();
            $table->timestamps();
        });
        
        Schema::table('preparation', function (Blueprint $table) {
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
        Schema::dropIfExists('preparation');
    }
}
