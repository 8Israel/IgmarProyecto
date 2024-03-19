<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use Illuminate\Http\Request;
use App\Models\Estadisticas;

class EstadisticasController extends Controller
{
    public function index(Request $request, $id = null)
    {
        if ($id) {
            $estadisticasQuery = Estadisticas::where('user_id', $id);
        } else {
            $user = auth()->user();
            $estadisticasQuery = Estadisticas::where('user_id', $user->id);
        }

        $sqlQuery = $estadisticasQuery->toSql();
        $estadisticas = $estadisticasQuery->get();
        $this->LogsMethod($request, auth()->user(), $sqlQuery);
        return response()->json($estadisticas);
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
