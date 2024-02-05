<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('TowerId');
            $table->unsignedBigInteger('Number');
            $table->foreignId('UserId');
            $table->foreign('UserId')->references('id')->on('Users')->onDelete('cascade');
            $table->foreignId('CategoryId');
            $table->foreign('CategoryId')->references('id')->on('Categories')->onDelete('cascade');
            $table->string('Subject');
            $table->boolean('Status')->default(0)->comment('0:pending,1:answer-admin,2:answer-client,3:completed,4:close');
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
        Schema::dropIfExists('tickets');
    }
}
