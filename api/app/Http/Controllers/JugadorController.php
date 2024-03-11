<?php

namespace App\Http\Controllers;

use App\Models\Jugador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class JugadorController extends Controller
{
    public function index()
    {
        $jugadores = DB::table('jugadores')
                        ->join('users', 'users.id', '=', 'jugadores.user_id')
                        ->where('users.activate', true)
                        ->select('jugadores.*')
                        ->get();
        return response()->json($jugadores);
    }

    public function store(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'nombre' => 'required|string',
                'user_id' => 'required|integer'
            ]);
            
            if($validate->fails()) {
                return response()->json(['error' => $validate->errors()], 400);
            }

            $jugador = new Jugador();
            $jugador->nombre = $request->nombre;
            $jugador->nivel = 1;
            $jugador->experiencia = 0;
            $jugador->puntuacion = 0;
            $jugador->user_id = $request->user_id;
            $jugador->save();
            return response()->json($jugador, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    
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