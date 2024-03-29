<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarioJugador extends Model
{
    protected $table = 'inventarios_users';
    protected $fillable = ['user_id', 'armas_id', 'heroes_id', 'cantidad'];

    public function jugador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function arma()
    {
        return $this->belongsTo(Arma::class, 'armas_id');
    }

    public function heroe()
    {
        return $this->belongsTo(Heroe::class, 'heroes_id');
    }
}
