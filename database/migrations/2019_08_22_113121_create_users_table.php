<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
    public function up()
    {
        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('user_id');
            $table->string('role', 20); // Роль
            $table->string('email')->unique();
            $table->string('password', 255);
            $table->string('name', 50);
            $table->string('surname', 50);
            $table->string('patronymic', 50);
            $table->string('photo')->nullable(); // Фото
            $table->string('rank', 50)->nullable(); // Звання
            $table->string('nominations', 50)->nullable(); // Номінація
            $table->text('informations')->nullable(); // Біографія / Членство в спілках журі
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
}