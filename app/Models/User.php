<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;


class User extends Model implements Authenticatable
{
    use AuthenticatableTrait;

    use HasFactory;

    protected $primaryKey = 'idUser';

    protected $fillable = [
        'username', 'email', 'password'
    ];

    public function sentMessages()
    {
        return $this->hasMany(Envoi::class, 'User_idSend');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Envoi::class, 'User_idReceive');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'User_idUser');
    }

    public function groupes()
    {
        return $this->hasMany(Participe_groupe::class, 'user_id');
    }

    public function groupe_has_messages()
    {
        return $this->hasMany(Groupe_has_message::class, 'user_id');
    }

    public function avis()
    {
        return $this->hasMany(Avis::class, 'user_id');
    }
}
