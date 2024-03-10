<?php

namespace App\Http\Controllers;

use App\Models\Mision;
use Illuminate\Http\Request;

class MisionController extends Controller
{
    public function index()
    {
        $misiones = Mision::all();
        return response()->json($misiones);
    }

    public function store(Request $request)
    {
        $mision = Mision::create($request->all());
        return response()->json($mision, 201);
    }

    public function show($id)
    {
        $mision = Mision::findOrFail($id);
        return response()->json($mision);
    }

    public function update(Request $request, $id)
    {
        $mision = Mision::findOrFail($id);
        $mision->update($request->all());
        return response()->json($mision, 200);
    }

    public function destroy($id)
    {
        $mision = Mision::findOrFail($id);
        $mision->delete();
        return response()->json(null, 204);
    }
}