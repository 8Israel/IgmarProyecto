<?php

namespace App\Http\Controllers;

use App\Models\Arma;
use Illuminate\Http\Request;
use Validator;

class ArmaController extends Controller
{
    public function index($id = null)
    {
        if (!$id) {
            $armas = Arma::all();
            return response()->json($armas);
        }
        else{
            $arma = Arma::where('id',$id)->first();
            return response()->json($arma);
        }
    }
    public function store(Request $request)
    {
        $validator =Validator::make($request->all(), [
            'nombre'=> 'required|max:10|min:3|string',
            'tipo'=> 'required|max:10|min:2|string',
            'rareza'=> 'required|max:10|min:3|string',
            'danio_base'=> 'required|integer|max:50',
            'nivel_requerido'=> 'required|integer|max:50',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->first()],400);
        }
        $arma = Arma::create($request->all());
        return response()->json(['mesagge'=>'Arma creada correctamente', 'data' => $arma], 201);
    }
    public function update(Request $request, $id)
    {
        $validator =Validator::make($request->all(), [
            'nombre'=> 'max:10|min:3|string',
            'tipo'=> 'max:10|min:2|string',
            'rareza'=> 'max:10|min:3|string',
            'danio_base'=> 'integer|max:50',
            'nivel_requerido'=> 'integer|max:50',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->first()],400);
        }
        $arma = Arma::findOrFail($id);
        if(!$arma){
            return response()->json(['error'=> 'arma no encontrada'],404);
        }
        $arma->update($request->all());
        return response()->json(['message'=> 'arma actualizada correctamente','data'=>$arma], 200);
    }

    public function destroy($id)
    {
        $arma = Arma::findOrFail($id);
        if(!$arma){
            return response()->json(['error'=> 'arma no encontrada'],404);
        }
        $arma->delete();
        return response()->json(['message'=> 'arma eliminada correctamente'], 200);
    }
}