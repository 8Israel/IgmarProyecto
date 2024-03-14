<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mision extends Model
{   
    protected $table = 'misiones';
    protected $fillable = ['nombre', 'tipo', 'recompensas_id'];
    public function recompensa()
    {
        return $this->belongsTo(Recompensa::class, 'recompensas_id'); // Cambia 'recompensas_id' por el nombre correcto de la clave foránea en tu tabla de misiones
    }
}
