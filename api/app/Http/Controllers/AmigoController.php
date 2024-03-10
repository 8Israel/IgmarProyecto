<?php

namespace App\Http\Controllers;

use App\Models\Amigo;
use Illuminate\Http\Request;

class AmigoController extends Controller
{
    public function index()
    {
        $amigos = Amigo::all();
        return response()->json($amigos);
    }

    public function store(Request $request)
    {
        $amigo = Amigo::create($request->all());
        return response()->json($amigo, 201);
    }

    public function show($id)
    {
        $amigo = Amigo::findOrFail($id);
        return response()->json($amigo);
    }

    public function update(Request $request, $id)
    {
        $amigo = Amigo::findOrFail($id);
        $amigo->update($request->all());
        return response()->json($amigo, 200);
    }

    public function destroy($id)
    {
        $amigo = Amigo::findOrFail($id);
        $amigo->delete();
        return response()->json(null, 204);
    }
}