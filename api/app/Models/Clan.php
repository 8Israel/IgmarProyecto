<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clan extends Model
{
    protected $table = 'clan';
    protected $fillable = ['nombre','lider','activate', 'nivel_clan'];

    public function lider()
    {
        return $this->belongsTo(User::class, 'lider_id');
    }

    public function miembros()
    {
        return $this->hasMany(ClanMiembro::class, 'clan_id');
    }
}
