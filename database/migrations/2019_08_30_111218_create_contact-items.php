<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact-items');
    }
    public function up()
    {
        Schema::dropIfExists('contact-items');

        Schema::create('contact-items', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('contact_items_id');
            $table->integer('contact_section_id')->unsigned();
            $table->string('contact_title', 100)->nullable();
            $table->string('contact', 100);

            $table->timestamps();
        });

        Schema::table('contact-items', function (Blueprint $table) {
            $table->index('contact_section_id');
            $table->foreign('contact_section_id')->references('contact_section_id')->on('contact_section');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

}
