<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvisTable extends Migration
{
    public function up()
    {
        Schema::create('avis', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('post_id');
            $table->tinyInteger('like')->nullable();
            $table->tinyInteger('repost')->nullable();
            $table->primary(['user_id', 'post_id']);
            $table->foreign('user_id')->references('idUser')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('post_id')->references('idpost')->on('posts')->onDelete('no action')->onUpdate('no action');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('avis');
    }
}
