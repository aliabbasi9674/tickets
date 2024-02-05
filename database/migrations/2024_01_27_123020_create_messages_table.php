<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('UserId');
            $table->foreign('UserId')->references('id')->on('Users')->onDelete('cascade');
            $table->foreignId('TicketId');
            $table->foreign('TicketId')->references('id')->on('Tickets')->onDelete('cascade');
            $table->longText('Content');
            $table->string('File1');
            $table->string('File2');
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
        Schema::dropIfExists('messages');
    }
}
