<?php

namespace App\Http\Controllers;

use App\Models\InventarioJugador;
use Illuminate\Http\Request;

class InventarioJugadorController extends Controller
{
    public function index()
    {
        $inventarios = InventarioJugador::all();
        return response()->json($inventarios);
    }

    public function store(Request $request)
    {
        $inventario = InventarioJugador::create($request->all());
        return response()->json($inventario, 201);
    }

    public function show($id)
    {
        $inventario = InventarioJugador::findOrFail($id);
        return response()->json($inventario);
    }

    public function update(Request $request, $id)
    {
        $inventario = InventarioJugador::findOrFail($id);
        $inventario->update($request->all());
        return response()->json($inventario, 200);
    }

    public function destroy($id)
    {
        $inventario = InventarioJugador::findOrFail($id);
        $inventario->delete();
        return response()->json(null, 204);
    }
}