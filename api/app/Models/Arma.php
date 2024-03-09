<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arma extends Model
{
    protected $table = 'armas';
    protected $fillable = ['nombre', 'tipo', 'rareza', 'danio_base', 'nivel_requerido'];
}
