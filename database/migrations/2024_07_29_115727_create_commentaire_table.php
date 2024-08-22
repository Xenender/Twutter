<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentaireTable extends Migration
{
    public function up()
    {
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id();
            $table->string('text', 500);
            $table->unsignedBigInteger('avis_user_id');
            $table->unsignedBigInteger('avis_post_id');
            $table->primary(['id', 'avis_user_id', 'avis_post_id']);
            $table->foreign(['avis_user_id', 'avis_post_id'])->references(['user_id', 'post_id'])->on('avis')->onDelete('no action')->onUpdate('no action');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('commentaires');
    }
}
