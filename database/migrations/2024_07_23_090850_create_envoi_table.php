<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('envois', function (Blueprint $table) {
            $table->unsignedBigInteger('User_idSend');
            $table->unsignedBigInteger('message_idmessage');
            $table->unsignedBigInteger('User_idReceive');
            $table->timestamp('date')->useCurrent();
            $table->primary(['User_idSend', 'message_idmessage', 'User_idReceive']);
            $table->foreign('User_idSend')->references('idUser')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('message_idmessage')->references('idmessage')->on('messages')->onDelete('no action')->onUpdate('no action');
            $table->foreign('User_idReceive')->references('idUser')->on('users')->onDelete('no action')->onUpdate('no action');
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
        Schema::dropIfExists('envois');
    }
};
