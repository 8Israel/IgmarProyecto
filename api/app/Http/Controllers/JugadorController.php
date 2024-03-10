<?php

namespace App\Http\Controllers;

use App\Models\Jugador;
use Illuminate\Http\Request;

class JugadorController extends Controller
{
    public function index()
    {
        $jugadores = Jugador::all();
        return response()->json($jugadores);
    }

    public function store(Request $request)
    {
        $jugador = Jugador::create($request->all());
        return response()->json($jugador, 201);
    }

    public function show($id)
    {
        $jugador = Jugador::findOrFail($id);
        return response()->json($jugador);
    }

    public function update(Request $request, $id)
    {
        $jugador = Jugador::findOrFail($id);
        $jugador->update($request->all());
        return response()->json($jugador, 200);
    }

    public function destroy($id)
    {
        $jugador = Jugador::findOrFail($id);
        $jugador->delete();
        return response()->json(null, 204);
    }
}