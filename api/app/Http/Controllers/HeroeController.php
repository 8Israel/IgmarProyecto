<?php

namespace App\Http\Controllers;

use App\Models\Heroe;
use Illuminate\Http\Request;
use Validator;

class HeroeController extends Controller
{
    public function index($id=null)
    {
        if (!$id) {
            $heroe = Heroe::all();
            return response()->json($heroe);
        }
        else{
            $heroe = Heroe::where('id',$id)->first();
            if(!$heroe){
                return response()->json(['error'=> 'heroe no encontrado'],404);
            }
            return response()->json($heroe);
        }
    }

    public function store(Request $request)
    {
        $validator =Validator::make($request->all(), [
            'nombre'=> 'required|max:10|min:3|string',
            'tipo'=> 'required|max:10|min:2|string',
            'rareza'=> 'required|max:10|min:3|string',
            'habilidad_especial'=> 'required|max:10|min:3|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->first()],400);
        }
        $heroe = Heroe::create($request->all());
        return response()->json(['mesagge'=>'Heroe creada correctamente', 'data' => $heroe], 200);
    }

    public function update(Request $request, $id)
    {
        $validator =Validator::make($request->all(), [
            'nombre'=> 'max:10|min:3|string',
            'tipo'=> 'max:10|min:2|string',
            'rareza'=> 'max:10|min:3|string',
            'habilidad_especial'=> 'max:10|min:3|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->first()],400);
        }
        $heroe = Heroe::findOrFail($id);
        if(!$heroe){
            return response()->json(['error'=> 'heroe no encontrado'],404);
        }
        $heroe->update($request->all());
        return response()->json(['message'=> 'heroe actualizado correctamente','data'=>$heroe], 200);
    }

    public function destroy($id)
    {
        $heroe = Heroe::findOrFail($id);
        if(!$heroe){
            return response()->json(['error'=> 'heroe no encontrado'],404);
        }
        $heroe->delete();
        return response()->json(['message'=> 'heroe eliminado correctamente'], 200);
    }
}
