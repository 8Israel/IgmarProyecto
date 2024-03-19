<?php

namespace App\Http\Controllers;

use App\Models\InventarioJugador;
use App\Models\Logs;
use Illuminate\Http\Request;
use App\Models\Arma;
use App\Models\Heroe;
use App\Models\User;

class InventarioJugadorController extends Controller
{
    public function index(Request $request, $id = null)
    {
        if ($id) {
            $inventarioQuery = InventarioJugador::where('user_id', $id);
        } else {
            $user = auth()->user();
            $inventarioQuery = InventarioJugador::where('user_id', $user->id);
        }
        $sqlQuery = $inventarioQuery->toSql();
        $inventario = $inventarioQuery->get();

        $datosInventario = [];
        foreach ($inventario as $item) {
            $arma = Arma::find($item->armas_id);
            $heroe = Heroe::find($item->heroes_id);

            $datosInventario[] = [
                'user' => $item->id,
                'arma' => $arma,
                'heroe' => $heroe
            ];
        }
        $this->LogsMethod($request, auth()->user(), $sqlQuery);
        return response()->json($datosInventario, 200);
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        InventarioJugador::where('user_id', $user->id)->update([
            'armas_id' => $request->input('arma_id'),
            'heroes_id' => $request->input('heroe_id'),
        ]);
        $this->LogsMethod($request, auth()->user(),["cambios"=>$request->all()]);
        return response()->json(['message' => 'inventario actualizado'], 200);
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