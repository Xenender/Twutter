<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Envoi extends Model
{
    use HasFactory;

    protected $primaryKey = ['User_idSend', 'message_idmessage', 'User_idReceive'];
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'User_idSend', 'message_idmessage', 'User_idReceive', 'date'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'User_idSend');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'User_idReceive');
    }

    public function message()
    {
        return $this->belongsTo(Message::class, 'message_idmessage');
    }
}
