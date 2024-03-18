<?php

namespace App\Http\Controllers;

use App\Models\Amigo;
use App\Models\Estadisticas;
use App\Models\User;
use Illuminate\Http\Request;

class AmigoController extends Controller
{
    public function store($id)
    {
        $user = auth()->user()->id;
        $amigo = Amigo::where('user_id', $user)->where('amigo', $id)->first();
        if(!$amigo) {
            if($user == $id) {
                return response()->json(['message'=> 'No puedes agregarte a ti mismo Kbron'],400);    
            }
            $amigo = Amigo::create([
                'user_id'=> $user,
                'amigo'=> $id,
            ]);
            return response()->json(['message'=> 'Amigo agregado correctamente','data'=>$amigo], 201);
        }
        else{
            return response()->json(['message'=> 'Esta persona ya es tu amigo','data'=>$amigo],400);
        }
    }
    public function destroy($id)
    {
        $usuario = auth()->user();
        $amigo = Amigo::where('user_id', $usuario->id)->where('amigo', $id)->first();
        if($amigo)
        {
            $amigo->delete();
            return response()->json(['message'=>'Amigo eliminado correctamente'], 200);
        }
        else
        {
            return response()->json(['message'=> 'amigo no encontrado'],404);
        }
    }
    public function show()
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
        return response()->json($datos);
    }


}