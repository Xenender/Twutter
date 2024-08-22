<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('groupe_has_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('groupe_id');
            $table->unsignedBigInteger('message_idmessage');
            $table->foreign('user_id')->references('idUser')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('groupe_id')->references('id')->on('groupes')->onDelete('no action')->onUpdate('no action');
            $table->foreign('message_idmessage')->references('idmessage')->on('messages')->onDelete('no action')->onUpdate('no action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groupe_has_messages');
    }
};
