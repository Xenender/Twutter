<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $primaryKey = 'idmessage';

    protected $fillable = [
        'text'
    ];

    public function envoies()
    {
        return $this->hasMany(Envoi::class, 'message_idmessage');
    }

    public function groupe_has_messages()
    {
        return $this->hasMany(Groupe_has_message::class, 'message_idmessage');
    }
}
