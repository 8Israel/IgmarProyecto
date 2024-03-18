<?php

namespace App\Http\Controllers;

use App\Models\Mision;
use App\Models\MisionCompletada;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Estadisticas;
class MisionesCompletadasController extends Controller
{
    public function store($idMision)
    {
        $user = auth()->user();
        $mision = Mision::find($idMision);
        if (!$mision) {
            return response()->json(['error'=> 'La misión indicada no existe'], 404);
        }
        if (MisionCompletada::where('user_id', $user->id)->where('mision_id', $idMision)->exists()) 
        {
            return response()->json(['error'=> 'El usuario ya completo esta mision'],404);
        }
        $recompensa = $mision->recompensa;

        $estadisticas = $user->estadisticas;
        $experienciaAnterior = $estadisticas->experiencia;
        $nuevaExperiencia = $experienciaAnterior + $recompensa->xp;
        $estadisticas->update(['experiencia' => $nuevaExperiencia]);
        
        $misionCompletada = MisionCompletada::create([
            'mision_id' => $idMision,
            'user_id' => $user->id
        ]);
        
        return response()->json($misionCompletada, 201);
    }

    public function showMisionesComplete($id = null)
    {
        $userId = $id ?: auth()->user()->id;
        if (!User::where('id', $userId)->exists()) 
        {
            return response()->json(['error'=> 'El usuario indicado no existe'],404);
        }
        $misionesCompletadas = MisionCompletada::where('user_id', $userId)->get();
        $misiones = Mision::with('recompensa')->whereIn('id', $misionesCompletadas->pluck('mision_id'))->get();

        return response()->json($misiones);
    }

    public function showMisionesInComplete($id = null)
    {
        $userId = $id ?: auth()->user()->id;
        if (!User::where('id', $userId)->exists()) 
        {
            return response()->json(['error'=> 'El usuario indicado no existe'],404);
        }
        $misionesCompletadas = MisionCompletada::where('user_id', $userId)->pluck('mision_id');
        $misionesInCompletas = Mision::with('recompensa')->whereNotIn('id', $misionesCompletadas)->get();

        return response()->json($misionesInCompletas);
    }

    
    public function destroy($id)
    {
        $misionCompletada = MisionCompletada::findOrFail($id);
        $misionCompletada->delete();
        return response()->json(null, 204);
    }
}