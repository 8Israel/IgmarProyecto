<?php

namespace App\Http\Controllers;

use App\Models\Amigo;
use App\Models\Estadisticas;
use App\Models\Logs;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AmigoController extends Controller
{
    public function store(Request $request, $id)
    {
        $userall = auth()->user();
        $user = $userall->id;

        $amigodata = User::where('id', $id)->first();
        $amigo = Amigo::where('user_id', $user)->where('amigo', $id)->first();

        if (!$amigo) {
            if ($user == $id) {
                return response()->json(['message' => 'No puedes agregarte a ti mismo Kbron'], 400);
            }
            $amigodataArray = [
                'id' => $amigodata->id,
                'name' => $amigodata->name,
                'email' => $amigodata->email,
            ];
            $this->LogsMethod($request, $userall, $amigodataArray);

            $amigo = Amigo::create([
                'user_id' => $user,
                'amigo' => $id,
            ]);
            return response()->json(['message' => 'Amigo agregado correctamente', 'data' => $amigo], 201);
        } else {
            return response()->json(['message' => 'Esta persona ya es tu amigo', 'data' => $amigo], 400);
        }
    }
    public function destroy(Request $request, $id)
    {
        $usuario = auth()->user();
        $amigodata = User::where('id', $id)->first();
        $amigo = Amigo::where('user_id', $usuario->id)->where('amigo', $id)->first();
        if ($amigo) {
            $amigodataArray = [
                'id' => $amigodata->id,
                'name' => $amigodata->name,
                'email' => $amigodata->email,
            ];
            $this->LogsMethod($request, $usuario, $amigodataArray);
            $amigo->delete();
            return response()->json(['message' => 'Amigo eliminado correctamente'], 200);
        } else {
            return response()->json(['message' => 'amigo no encontrado'], 404);
        }
    }

    public function show(Request $request)
    {
        $usuario = auth()->user();

        $amigos_ids = Amigo::where('user_id', $usuario->id)->pluck('amigo');
        $amigosUsuarios = User::whereIn('id', $amigos_ids)->get();
        $datos = [];
        foreach ($amigosUsuarios as $amigo) {
            $estadisticas = Estadisticas::where('user_id', $amigo->id)->first();
            $datos[] = [
                'amigo' => $amigo,
                'estadisticas' => $estadisticas
            ];
        }
        $amigos_ids_sql = Amigo::where('user_id', $usuario->id)->toSql();
        $amigos_usuarios_sql = User::whereIn('id', $amigos_ids)->toSql();
        $estadisticas_sql = Estadisticas::whereIn('user_id', $amigos_ids)->toSql();
        
        $this->LogsMethod($request, $usuario, [
            'amigos_ids_sql' => $amigos_ids_sql,
            'amigos_usuarios_sql' => $amigos_usuarios_sql,
            'estadisticas_sql' => $estadisticas_sql,
        ]);

        return response()->json($datos);
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