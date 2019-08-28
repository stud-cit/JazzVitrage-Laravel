<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFotoGalletyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foto_gallery', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('foto_id');
            $table->string('file', 100);
            $table->string('type', 50);
            $table->string('year', 4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foto_gallery');
    }
}
