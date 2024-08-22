<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    use HasFactory;

    protected $table = 'avis';
    protected $primaryKey = ['user_id', 'post_id'];
    public $incrementing = false;
    protected $keyType = 'array';

    protected $fillable = ['user_id', 'post_id', 'like', 'repost'];

    public function user()
    {
        return $this->belongsTo(User::class,'idUser');
    }

    public function post()
    {
        return $this->belongsTo(Post::class,'idpost');
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, ['avis_user_id', 'avis_post_id'], ['user_id', 'post_id']);
    }
}