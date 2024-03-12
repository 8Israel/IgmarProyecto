<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class Estadisticas extends Model
{
    protected $table = 'estadisticas'; // Nombre correcto de la tabla

    protected $fillable = ['nivel', 'experiencia', 'puntuacion', 'user_id'];

    public function inventario()
    {
        return $this->hasMany(InventarioJugador::class, 'user_id');
    }

    public function misionesCompletadas()
    {
        return $this->hasMany(MisionCompletada::class, 'user_id');
    }

    public function amigos()
    {
        return $this->hasMany(Amigo::class, 'user_id');
    }

    public function clan()
    {
        return $this->hasOne(Clan::class, 'lider_id');
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
