<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $primaryKey = 'idpost';

    protected $fillable = [
        'text', 'date', 'User_idUser'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'User_idUser');
    }
}
