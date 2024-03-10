<?php

namespace App\Http\Controllers;

use App\Models\Arma;
use Illuminate\Http\Request;

class ArmaController extends Controller
{
    public function index()
    {
        $armas = Arma::all();
        return response()->json($armas);
    }

    public function store(Request $request)
    {
        $arma = Arma::create($request->all());
        return response()->json($arma, 201);
    }

    public function show($id)
    {
        $arma = Arma::findOrFail($id);
        return response()->json($arma);
    }

    public function update(Request $request, $id)
    {
        $arma = Arma::findOrFail($id);
        $arma->update($request->all());
        return response()->json($arma, 200);
    }

    public function destroy($id)
    {
        $arma = Arma::findOrFail($id);
        $arma->delete();
        return response()->json(null, 204);
    }
}