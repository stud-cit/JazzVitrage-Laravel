<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionSection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('position_section');
    }
    public function up()
    {
        Schema::dropIfExists('position_section');

        Schema::create('position_section', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('provisions_text');
            $table->string('video', 100)->nullable();
            $table->string('file', 100)->nullable();
            $table->string('personal_data', 100)->nullable();
            $table->string('compress_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
}
