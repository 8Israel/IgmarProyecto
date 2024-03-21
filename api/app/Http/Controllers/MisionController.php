<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use App\Models\Mision;
use App\Models\User;
use App\Models\Recompensa;
use App\Models\MisionCompletada;
use Illuminate\Http\Request;
use Validator;

class MisionController extends Controller
{
    public function index(Request $request, $id = null)
    {
        if (!$id) {
            $query = Mision::with('recompensa');

        } else {
            $query = Mision::where('id', $id)->with('recompensa');
        }
        $sqlQuery = $query->toSql();
        $misiones = $query->get();
        $this->LogsMethod($request, auth()->user(), $sqlQuery);
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
            return response()->json(['error' => 'la recompensa indicada no existe'], 404);
        }
        $mision = new Mision();
        $mision->nombre = $request->nombre;
        $mision->tipo = $request->tipo;
        $mision->recompensas_id = $request->recompensas_id;
        $mision->save();
        $this->LogsMethod($request, auth()->user());
        return response()->json(['message' => 'Mision creada correctamente', 'data' => $mision], 201);
    }
    public function update(Request $request, $id)
    {
        if (!Mision::where('id', $id)->exists()) {
            return response()->json(['error' => 'La mision indicada no existe'], 404);
        }
        $validator = Validator::make($request->all(), [
            "nombre" => 'string|min:3|max:20',
            "tipo" => 'string|min:3|max:100',
            'recompensas_id' => 'integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 404);
        }
        if ($request->has('recompensas_id') && !Recompensa::where('id', $request->recompensas_id)->exists()) {
            return response()->json(['error' => 'la recompensa indicada no existe'], 404);
        }
        $this->LogsMethod($request, auth()->user(), ["modificado" => $request->all(), "mision" => $id]);
        $mision = Mision::findOrFail($id);
        $mision->update($request->all());
        return response()->json(['message' => 'Mision actualizada correctamente', 'data' => $mision], 200);
    }

    public function destroy(Request $request, $id)
    {
        if (!Mision::where('id', $id)->exists()) {
            return response()->json(['error' => 'La mision indicada no existe'], 404);
        }
        $mision = Mision::findOrFail($id);
        $this->LogsMethod($request, auth()->user(), $mision->toArray());
        $mision->delete();
        return response()->json(['message' => 'Mision eliminada correctamente'], 200);
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
            "date"=> now()->toString(),
            "data" =>  json_encode($data),
            "verb" => $request->method(),
        ]);
    }
    
}