<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estadisticas;

class EstadisticasController extends Controller
{
    public function index($id=null)
    {
        if($id){
            $estadisticas = Estadisticas::where('user_id', $id)->get();
            return response()->json($estadisticas);
        }
        else{
            $user = auth()->user()->id;
            $estadisticas = Estadisticas::where('user_id', $user)->get();
            return response()->json($estadisticas);
        }
    }
}
