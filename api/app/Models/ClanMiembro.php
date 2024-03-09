<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClanMiembro extends Model
{
    protected $table = 'clan_miembros';
    protected $fillable = ['clan_id', 'jugador_id', 'rango'];

    public function clan()
    {
        return $this->belongsTo(Clan::class, 'clan_id');
    }

    public function jugador()
    {
        return $this->belongsTo(Jugador::class, 'jugador_id');
    }
}
