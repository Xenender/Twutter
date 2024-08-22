<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participe_groupe extends Model
{
    use HasFactory;

    public $incrementing = false;
    
    protected $fillable = [
        'groupe_id','user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function groupe()
    {
        return $this->belongsTo(Groupe::class,'groupe_id');
    }
}
