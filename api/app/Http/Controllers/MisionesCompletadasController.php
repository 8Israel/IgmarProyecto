<?php

namespace App\Http\Controllers;

use App\Models\Logs;
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
        $this->LogsMethod(request(), auth()->user(), $mision->toArray());
        
        return response()->json($misionCompletada, 201);
    }

    public function showMisionesComplete($id = null)
    {
        $userId = $id ?: auth()->user()->id;
        if (!User::where('id', $userId)->exists()) {
            return response()->json(['error' => 'El usuario indicado no existe'], 404);
        }

        $misionesCompletadasQuery = MisionCompletada::where('user_id', $userId);
        $sqlQuery = $misionesCompletadasQuery->toSql();
        $misionesCompletadas = $misionesCompletadasQuery->get();
        $misionesQuery = Mision::with('recompensa')->whereIn('id', $misionesCompletadas->pluck('mision_id'));
        $sqlQuery .= ' ' . $misionesQuery->toSql();

        $misiones = $misionesQuery->get();

        $this->LogsMethod(request(), auth()->user(), $sqlQuery);
        return response()->json($misiones);
    }


    public function showMisionesInComplete(Request $request, $id = null)
    {
        $userId = $id ?: auth()->user()->id;

        if (!User::where('id', $userId)->exists()) {
            return response()->json(['error' => 'El usuario indicado no existe'], 404);
        }

        $misionesCompletadas = MisionCompletada::where('user_id', $userId)->pluck('mision_id');
        $misionesInCompletasQuery = Mision::with('recompensa')->whereNotIn('id', $misionesCompletadas);
        $sqlQuery = $misionesInCompletasQuery->toSql();
        $misionesInCompletas = $misionesInCompletasQuery->get();

        $this->LogsMethod($request, auth()->user(), $sqlQuery);
        return response()->json($misionesInCompletas);
    }


    public function destroy(Request $request,$id)
    {
        $misionCompletada = MisionCompletada::findOrFail($id);
        $this->LogsMethod($request, auth()->user(), $misionCompletada->toArray());
        $misionCompletada->delete();
        return response()->json(null, 204);
    }

    public function LogsMethod(Request $request, $user, $query = null)
    {
        if (!$query) {
            $data = $request->all();
        } else {
            $data = $query;
        }
        Logs::create([
            "user_id" => $user->id,
            "data" => $data,
            "verb" => $request->method(),
        ]);
    }
}