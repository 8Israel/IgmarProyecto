<?php

namespace App\Http\Controllers;

use App\Models\Mision;
use App\Models\User;
use App\Models\Recompensa;
use App\Models\MisionCompletada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class MisionController extends Controller
{
    public function index($id = null)
    {
        $misiones = Mision::with('recompensa')->get();
        return response()->json($misiones);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nombre" => 'required|string|min:3|max:20|unique:misiones',
            "tipo" => 'required|string|min:3|max:100',
            'recompensas_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 404);
        }
        if (!Recompensa::where('id', $request->recompensas_id)->exists()) {
            return response()->json(['error'=> 'la recompensa indicada no existe'],404);
        }
        $mision = Mision::create($request->all());
        return response()->json(['message' => 'Mision creada correctamente', 'data' => $mision], 201);
    }
    public function update(Request $request, $id)
    {
        if (!Mision::where('id', $id)->exists()) {
            return response()->json(['error'=> 'La mision indicada no existe'],404);
        }
        $validator = Validator::make($request->all(), [
            "nombre" => 'string|min:3|max:20|unique:misiones',
            "tipo" => 'string|min:3|max:100',
            'recompensas_id' => 'integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 404);
        }
        if ($request->has('recompensas_id') && !Recompensa::where('id', $request->recompensas_id)->exists())
        {
            return response()->json(['error'=> 'la recompensa indicada no existe'],404);
        }
        $mision = Mision::findOrFail($id);
        $mision->update($request->all());
        return response()->json(['message' => 'Mision actualizada correctamente', 'data' => $mision], 200);
    }

    public function destroy($id)
    {
        if (!Mision::where('id', $id)->exists()) {
            return response()->json(['error'=> 'La mision indicada no existe'],404);
        }
        $mision = Mision::findOrFail($id);
        $mision->delete();
        return response()->json(['message' => 'Mision eliminada correctamente'],200);
    }
}