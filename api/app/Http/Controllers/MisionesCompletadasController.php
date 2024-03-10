<?php

namespace App\Http\Controllers;

use App\Models\MisionCompletada;
use Illuminate\Http\Request;

class MisionesCompletadasController extends Controller
{
    public function index()
    {
        $misionesCompletadas = MisionCompletada::all();
        return response()->json($misionesCompletadas);
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