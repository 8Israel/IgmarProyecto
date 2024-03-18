<?php

namespace App\Http\Controllers;

use App\Models\Arma;
use App\Models\Logs;
use Illuminate\Http\Request;
use Validator;

class ArmaController extends Controller
{
    public function index(Request $request, $id = null)
    {
        $user = auth()->user();
        if (!$id) {
            $armas = Arma::all();
            $sqlQuery = Arma::toBase()->toSql();
            $this->LogsMethod($request, $user, $sqlQuery);
            return response()->json($armas);
        } else {
            $arma = Arma::where('id', $id)->first();
            $sqlQuery = Arma::where('id', $id)->toBase()->toSql();
            $this->LogsMethod($request, $user, $sqlQuery);
            return response()->json($arma);
        }
    }
    public function store(Request $request)
    {
        $user = auth()->user();
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:10|min:3|string',
            'tipo' => 'required|max:10|min:2|string',
            'rareza' => 'required|max:10|min:3|string',
            'danio_base' => 'required|integer|max:50'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }
        $this->LogsMethod($request, $user);
        $arma = Arma::create($request->all());
        return response()->json(['mesagge' => 'Arma creada correctamente', 'data' => $arma], 201);
    }
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $validator = Validator::make($request->all(), [
            'nombre' => 'max:10|min:3|string',
            'tipo' => 'max:10|min:2|string',
            'rareza' => 'max:10|min:3|string',
            'danio_base' => 'integer|max:50'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }
        $arma = Arma::find($id);
        if (!$arma) {
            return response()->json(['error' => 'arma no encontrada'], 404);
        }
        $this->LogsMethod($request, $user, ['nuevo'=> $request->all(), 'arma_id'=> $id]);
        $arma->update($request->all());
        return response()->json(['message' => 'arma actualizada correctamente', 'data' => $arma], 200);
    }

    public function destroy(Request $request, $id)
    {
        $user = auth()->user();
        $arma = Arma::find($id);
        if (!$arma) {
            return response()->json(['error' => 'arma no encontrada'], 404);
        }
        $this->LogsMethod($request, $user, $arma->toArray());
        $arma->delete();
        return response()->json(['message' => 'arma eliminada correctamente'], 200);
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