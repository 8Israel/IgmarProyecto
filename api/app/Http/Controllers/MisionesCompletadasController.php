<?php

namespace App\Http\Controllers;

use App\Models\Mision;
use App\Models\MisionCompletada;
use Illuminate\Http\Request;

class MisionesCompletadasController extends Controller
{
    public function showMisionesComplete($id = null)
    {
        $userId = $id ?: auth()->user()->id;
        $misionesCompletadas = MisionCompletada::where('user_id', $userId)->get();
        $misiones = Mision::with('recompensa')->whereIn('id', $misionesCompletadas->pluck('mision_id'))->get();

        return response()->json($misiones);
    }

    public function showMisionesInComplete($id = null)
    {
        $userId = $id ?: auth()->user()->id;
        $misionesCompletadas = MisionCompletada::where('user_id', $userId)->pluck('mision_id');
        $misionesInCompletas = Mision::with('recompensa')->whereNotIn('id', $misionesCompletadas)->get();

        return response()->json($misionesInCompletas);
    }

    public function store(Request $request)
    {
        $misionCompletada = MisionCompletada::create($request->all());
        return response()->json($misionCompletada, 201);
    }

    public function show($id)
    {
        $misionCompletada = MisionCompletada::findOrFail($id);
        return response()->json($misionCompletada);
    }

    public function update(Request $request, $id)
    {
        $misionCompletada = MisionCompletada::findOrFail($id);
        $misionCompletada->update($request->all());
        return response()->json($misionCompletada, 200);
    }

    public function destroy($id)
    {
        $misionCompletada = MisionCompletada::findOrFail($id);
        $misionCompletada->delete();
        return response()->json(null, 204);
    }
}