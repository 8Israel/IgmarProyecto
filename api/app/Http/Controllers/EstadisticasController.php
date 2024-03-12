<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estadisticas;

class EstadisticasController extends Controller
{
    public function index()
    {
        $misiones = Estadisticas::all();
        return response()->json($misiones);
    }

    public function store(Request $request)
    {
        $mision = Estadisticas::create($request->all());
        return response()->json($mision, 201);
    }

    public function show($id)
    {
        $mision = Estadisticas::findOrFail($id);
        return response()->json($mision);
    }

    public function update(Request $request, $id)
    {
        $mision = Estadisticas::findOrFail($id);
        $mision->update($request->all());
        return response()->json($mision, 200);
    }

    public function destroy($id)
    {
        $mision = Estadisticas::findOrFail($id);
        $mision->delete();
        return response()->json(null, 204);
    }
}
