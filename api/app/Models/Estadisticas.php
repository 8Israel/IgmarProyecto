<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class Estadisticas extends Model
{
    protected $table = 'estadisticas'; // Nombre correcto de la tabla

    protected $fillable = ['nivel', 'experiencia', 'puntuacion', 'user_id'];


    public function misionesCompletadas()
    {
        return $this->hasMany(MisionCompletada::class, 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
