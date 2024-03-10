<?php

namespace App\Http\Controllers;

use App\Models\Recompensa;
use Illuminate\Http\Request;

class RecompensaController extends Controller
{
    public function index()
    {
        $recompensas = Recompensa::all();
        return response()->json($recompensas);
    }

    public function store(Request $request)
    {
        $recompensa = Recompensa::create($request->all());
        return response()->json($recompensa, 201);
    }

    public function show($id)
    {
        $recompensa = Recompensa::findOrFail($id);
        return response()->json($recompensa);
    }

    public function update(Request $request, $id)
    {
        $recompensa = Recompensa::findOrFail($id);
        $recompensa->update($request->all());
        return response()->json($recompensa, 200);
    }

    public function destroy($id)
    {
        $recompensa = Recompensa::findOrFail($id);
        $recompensa->delete();
        return response()->json(null, 204);
    }
}