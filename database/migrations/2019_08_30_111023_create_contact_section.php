<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactSection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_section');
    }
    public function up()
    {
        Schema::create('contact_section', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('contact_section_id');
            $table->string('caption', 45);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
}
