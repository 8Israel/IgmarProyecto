<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Heroe extends Model
{

    protected $table = 'heroes';
    protected $fillable = ['nombre', 'tipo', 'rareza', 'habilidad_especial'];
}

