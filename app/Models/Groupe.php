<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function participe_groupes()
    {
        return $this->hasMany(Participe_groupe::class, 'groupe_id');
    }

    public function groupe_has_messages()
    {
        return $this->hasMany(Groupe_has_message::class, 'groupe_id');
    }
}
