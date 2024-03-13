<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClanMiembro extends Model
{
    protected $table = 'clan_miembros';
    protected $fillable = ['clan_id', 'user_id', 'rango'];

    public function clan()
    {
        return $this->belongsTo(Clan::class, 'clan_id');
    }

    public function jugador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
