<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class Jugador extends Model
{
    protected $table = 'jugadores'; // Nombre correcto de la tabla

    protected $fillable = ['nombre', 'nivel', 'experiencia', 'puntuacion'];

    public function inventario()
    {
        return $this->hasMany(InventarioJugador::class, 'jugador_id');
    }

    public function misionesCompletadas()
    {
        return $this->hasMany(MisionCompletada::class, 'jugador_id');
    }

    public function amigos()
    {
        return $this->hasMany(Amigo::class, 'jugador_id');
    }

    public function clan()
    {
        return $this->hasOne(Clan::class, 'lider_id');
    }
}
