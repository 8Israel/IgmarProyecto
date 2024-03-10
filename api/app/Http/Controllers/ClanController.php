<?php

namespace App\Http\Controllers;

use App\Models\Clan;
use Illuminate\Http\Request;

class ClanController extends Controller
{
    public function index()
    {
        $clanes = Clan::all();
        return response()->json($clanes);
    }

    public function store(Request $request)
    {
        $clan = Clan::create($request->all());
        return response()->json($clan, 201);
    }

    public function show($id)
    {
        $clan = Clan::findOrFail($id);
        return response()->json($clan);
    }

    public function update(Request $request, $id)
    {
        $clan = Clan::findOrFail($id);
        $clan->update($request->all());
        return response()->json($clan, 200);
    }

    public function destroy($id)
    {
        $clan = Clan::findOrFail($id);
        $clan->delete();
        return response()->json(null, 204);
    }
}
