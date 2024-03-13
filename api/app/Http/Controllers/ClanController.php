<?php

namespace App\Http\Controllers;

use App\Models\Clan;
use App\Models\User;
use Illuminate\Http\Request;

use App\Models\ClanMiembro;
use Illuminate\Support\Facades\Validator;

class ClanController extends Controller
{
    public function index($id = null)
    {
        if (!$id) {
            $clanes = Clan::where('activate', true)->get();
            return response()->json($clanes);
        }
        else{
            $clanes = Clan::where('id', $id)->first();
            return response()->json($clanes);
        }

    }

    public function store(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            "nombre" => "required|string|min:3|max:15|unique:clan",
        ]);
        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()], 422);
        }
        if ($id == null) {
            $user = auth()->user();
            $newClan = Clan::create([
                "nombre" => $request->nombre,
                "nivel_clan" => 1,
                "lider" => $user->id
            ]);
            return response()->json(["message" => "Clan creado Correctamente", "clan" => $newClan], 200);
        } else {
            $newClan = Clan::create([
                "nombre" => $request->nombre,
                "nivel_clan" => 1,
                "lider" => $id
            ]);
            $user = User::find($id);
            return response()->json(["message" => "Clan creado Correctamente", "data" => $newClan, 'lider' => $user], 200);
        }
    }

    public function show($id = null)
    {
        if ($id) {
            $clan = Clan::where('lider', $id)->where('activo', true)->get();
            return response()->json(['message' => "Tus clanes", "clanes" => $clan], 200);
        } else {
            $user = auth()->user();
            $clan = Clan::where('lider', $user->id)->where('activate', true)->get();
            return response()->json(['message' => "Tus clanes", "clanes" => $clan], 200);
        }

    }
    public function delete($id)
    {
        $user = auth()->user();
        $clanid = Clan::where('lider', $user->id)->where('id', $id)->first();
        if (!$clanid) {
            return response()->json(['message' => 'este clan no te pertenece'], 200);
        }
        $clan = Clan::findOrFail($id);
        $clan->activate = false;
        $clan->save();
        return response()->json(['clan desactivado' => $clan], 200);
    }
    public function deleteAdmin($id)
    {
        $clan = Clan::where('lider', $id)->first();
        if (!$clan) {
            return response()->json(["message" => "clan no encontrado"], 404);
        }
        $clan->activate = false;
        $clan->save();
        return response()->json(['clan desactivado' => $clan], 200);
    }
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            "nombre" => "required|string|min:3|max:15|unique:clan",
        ]);
        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()], 422);
        }
        $user = auth()->user();
        $clanid = Clan::where('lider', $user->id)->where('id', $id)->first();
        if (!$clanid) {
            return response()->json(['message' => 'este clan no te pertenece'], 200);
        }
        $clan = Clan::findOrFail($id);
        $clan->nombre = $request->nombre;
        $clan->save();
    }
}
