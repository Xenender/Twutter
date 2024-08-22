<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    protected $table = 'commentaires';

    protected $fillable = ['text', 'avis_user_id', 'avis_post_id'];

    public function avis()
    {
        return $this->belongsTo(Avis::class, ['avis_user_id', 'avis_post_id'], ['user_id', 'post_id']);
    }
}