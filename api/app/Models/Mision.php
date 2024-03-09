<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mision extends Model
{
    protected $table = 'misiones';
    protected $fillable = ['nombre', 'tipo', 'recompensa_xp', 'recompensa_items'];
}
