<?php

namespace App\Http\Controllers;

use App\Models\ClanMiembro;
use Illuminate\Http\Request;

class ClanMiembroController extends Controller
{
    public function index()
    {
        $clanMiembros = ClanMiembro::all();
        return response()->json($clanMiembros);
    }

    public function store(Request $request)
    {
        $clanMiembro = ClanMiembro::create($request->all());
        return response()->json($clanMiembro, 201);
    }

    public function show($id)
    {
        $clanMiembro = ClanMiembro::findOrFail($id);
        return response()->json($clanMiembro);
    }

    public function update(Request $request, $id)
    {
        $clanMiembro = ClanMiembro::findOrFail($id);
        $clanMiembro->update($request->all());
        return response()->json($clanMiembro, 200);
    }

    public function destroy($id)
    {
        $clanMiembro = ClanMiembro::findOrFail($id);
        $clanMiembro->delete();
        return response()->json(null, 204);
    }
}