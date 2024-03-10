<?php

namespace App\Http\Controllers;

use App\Models\Heroe;
use Illuminate\Http\Request;

class HeroeController extends Controller
{
    public function index()
    {
        $heroes = Heroe ::all();
        return response()->json($heroes);
    }

    public function store(Request $request)
    {
        $heroe = Heroe::create($request->all());
        return response()->json($heroe, 201);
    }

    public function show($id)
    {
        $heroe = Heroe::findOrFail($id);
        return response()->json($heroe);
    }

    public function update(Request $request, $id)
    {
        $heroe = Heroe::findOrFail($id);
        $heroe->update($request->all());
        return response()->json($heroe, 200);
    }

    public function destroy($id)
    {
        $heroe = Heroe::findOrFail($id);
        $heroe->delete();
        return response()->json(null, 204);
    }
}
