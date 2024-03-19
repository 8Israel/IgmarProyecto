<?php

namespace App\Http\Controllers;

use App\Models\Heroe;
use App\Models\Logs;
use Illuminate\Http\Request;
use Validator;

class HeroeController extends Controller
{
    public function index(Request $request, $id=null)
    {
        if (!$id) {
            $heroe = Heroe::all();
            $sqlQuery = Heroe::toBase()->toSql();
            $this->LogsMethod($request, auth()->user(), $sqlQuery);
            return response()->json($heroe);
        }
        else{
            $heroe = Heroe::where('id',$id)->first();
            if(!$heroe){
                return response()->json(['error'=> 'heroe no encontrado'],404);
            }
            $sqlQuery = Heroe::where('id', $id)->toBase()->toSql();
            $this->LogsMethod($request, auth()->user(), $sqlQuery);
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
        $this->LogsMethod($request, auth()->user());
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
        $heroe = Heroe::find($id);
        if(!$heroe){
            return response()->json(['error'=> 'heroe no encontrado'],404);
        }
        $this->LogsMethod($request, auth()->user(), ['nuevo'=> $request->all(), 'heroe_id'=> $id]);
        $heroe->update($request->all());
        return response()->json(['message'=> 'heroe actualizado correctamente','data'=>$heroe], 200);
    }

    public function destroy(Request $request, $id)
    {
        $heroe = Heroe::find($id);
        if(!$heroe){
            $this->LogsMethod($request, auth()->user(), $heroe->toArray());
            return response()->json(['error'=> 'heroe no encontrado'],404);
        }
        $this->LogsMethod($request, auth()->user(), $heroe->toArray());
        $heroe->delete();
        return response()->json(['message'=> 'heroe eliminado correctamente'], 200);
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
