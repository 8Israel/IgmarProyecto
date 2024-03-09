<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Amigo extends Model
{
    protected $table = 'amigos';
    protected $fillable = ['jugador_id', 'nombre_amigo'];

    public function jugador()
    {
        return $this->belongsTo(Jugador::class, 'jugador_id');
    }
}
