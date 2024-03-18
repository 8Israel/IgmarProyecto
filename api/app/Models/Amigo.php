<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Amigo extends Model
{
    protected $table = 'amigos';
    protected $fillable = ['user_id', 'amigo'];

    public function jugador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
