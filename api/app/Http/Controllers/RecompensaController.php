<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use App\Models\Mision;
use App\Models\Recompensa;
use Illuminate\Http\Request;
use Validator;

class RecompensaController extends Controller
{
    public function index()
    {
        $query = Recompensa::query();
        $sqlQuery = $query->toSql();
        $recompensas = $query->get();
        $this->LogsMethod(request(), auth()->user(), $sqlQuery);
        return response()->json($recompensas);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "tipo" => "string|max:15|min:2|required",
            "xp" => 'integer|required|max:20|min:5'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 400);
        }
        $recompensa = Recompensa::create($request->all());
        $this->LogsMethod($request, auth()->user());
        return response()->json(['message' => 'recompensa creada correctamente', 'data' => $recompensa], 201);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "tipo" => "string|max:15|min:2",
            "xp" => 'integer|max:20|min:5'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 400);
        }
        $recompensa = Recompensa::findOrFail($id);
        $recompensa->update($request->all());
        $this->LogsMethod($request, auth()->user(), ["modificacion" => $request->all(), "recompensa" => $id]);
        return response()->json(['message' => 'recompensa actualizada correctamente', 'data' => $recompensa], 200);
    }

    public function destroy($id)
    {
        $recompensa = Recompensa::find($id);
        if (!$recompensa) {
            return response()->json(['error' => 'Esta recompensa no existe'], 404);
        }

        $recompensaReemplazo = Recompensa::find(1);
        if (!$recompensaReemplazo) {
            return response()->json(['error' => 'La recompensa de reemplazo no existe'], 404);
        }

        Mision::where('recompensas_id', $id)->update(['recompensas_id' => $recompensaReemplazo->id]);

        $this->LogsMethod(request(), auth()->user(), $recompensa->toArray());
        $recompensa->delete();

        return response()->json(['message' => 'Recompensa eliminada correctamente y misiones actualizadas'], 200);
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