<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MisionCompletada extends Model
{
    protected $table = 'misiones_completadas';
    protected $fillable = ['jugador_id', 'mision_id', 'fecha_completado'];

    public function jugador()
    {
        return $this->belongsTo(Jugador::class, 'jugador_id');
    }

    public function mision()
    {
        return $this->belongsTo(Mision::class, 'mision_id');
    }
}
