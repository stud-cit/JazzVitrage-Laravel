<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoloDuetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solo_duet', function (Blueprint $table) {
            $table->increments('solo_id');
            $table->string('name', 50);
            $table->string('surname', 50);
            $table->string('patronymic', 50);
            $table->string('member_email', 50);
            $table->string('member_address', 150);
            $table->date('data_birthday');
            $table->string('passport_data');
            $table->string('passport_photo');
            $table->string('in', 50);
            $table->string('in_file');
            $table->string('parent_name', 50);
            $table->string('parent_surname', 50);
            $table->string('parent_patronymic', 50);
            $table->integer('is_duet');
            $table->integer('application_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('solo_duet', function (Blueprint $table) {
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
        Schema::dropIfExists('solo_duet');
    }
}
