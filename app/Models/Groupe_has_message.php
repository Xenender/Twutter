<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe_has_message extends Model
{
    use HasFactory;


    protected $primaryKey = ['message_idmessage', 'groupe_id'];
    public $incrementing = false;
    protected $keyType = 'array';
    
    protected $fillable = [
        'groupe_id','message_idmessage','user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class,'idUser');
    }

    public function groupe()
    {
        return $this->belongsTo(Groupe::class,'id');
    }

    public function message()
    {
        return $this->belongsTo(Message::class,'idmessage');
    }
}
