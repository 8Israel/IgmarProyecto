<?php

namespace App\Http\Controllers;

use App\Models\Recompensa;
use Illuminate\Http\Request;
use Validator;

class RecompensaController extends Controller
{
    public function index()
    {
        $recompensas = Recompensa::all();
        return response()->json($recompensas);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "tipo"=> "string|max:15|min:2|required",
            "xp"=> 'integer|required|max:20|min:5'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()], 400);
        }
        $recompensa = Recompensa::create($request->all());
        return response()->json(['message'=>'recompensa creada correctamente','data'=>$recompensa], 201);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "tipo"=> "string|max:15|min:2",
            "xp"=> 'integer|max:20|min:5'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()], 400);
        }
        $recompensa = Recompensa::findOrFail($id);
        $recompensa->update($request->all());
        return response()->json(['message'=>'recompensa actualizada correctamente','data'=>$recompensa], 200);
    }

    public function destroy($id)
    {
        if (!Recompensa::where('id', $id)->exists()) {
            return response()->json(['error'=> 'Esta recompensa no existe'],404);
        }
        $recompensa = Recompensa::findOrFail($id);
        $recompensa->delete();
        return response()->json(['message'=>'Recompensa eliminada correctamente'], 200);
    }
}