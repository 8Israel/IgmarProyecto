<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recompensa extends Model
{
    protected $table = 'recompensas';
    protected $fillable = ['tipo', 'descripcion', 'valor'];
}
