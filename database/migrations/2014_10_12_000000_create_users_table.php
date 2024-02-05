<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Users', function (Blueprint $table) {
            $table->id();
            $table->string('Name')->nullable();
            $table->string('LoginToken');
            $table->integer('Phone');
            $table->string('Email')->unique()->nullable();
            $table->string('Password')->nullable();
            $table->tinyInteger('Role');
            $table->boolean('Status')->default(1);
            $table->string('Avatar')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
