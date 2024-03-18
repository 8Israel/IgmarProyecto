<?php

namespace App\Http\Controllers;

use App\Models\InventarioJugador;
use Illuminate\Http\Request;
use App\Models\Arma;
use App\Models\Heroe;
use App\Models\User;

class InventarioJugadorController extends Controller
{
    public function index($id = null)
    {
        if ($id) {
            $inventario = InventarioJugador::where('user_id', $id)->get();
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
            return response()->json($datosInventario, 200);
        } else {
            $user = auth()->user();
            $inventario = InventarioJugador::where('user_id', $user->id)->get();
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
            return response()->json($datosInventario, 200);
        }
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        InventarioJugador::where('user_id', $user->id)->update([
            'armas_id' => $request->input('arma_id'),
            'heroes_id' => $request->input('heroe_id'),
        ]);
        return response()->json(['message' => 'inventario actualizado'], 200);
    }
}