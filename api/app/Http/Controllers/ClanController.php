<?php

namespace App\Http\Controllers;

use App\Models\Clan;
use App\Models\Logs;
use App\Models\User;
use Illuminate\Http\Request;

use App\Models\ClanMiembro;
use Illuminate\Support\Facades\Validator;

class ClanController extends Controller
{
    public function index(Request $request, $id = null)
    {
        $user = auth()->user();
        if (!$id) {
            $clanes = Clan::where('activate', true)->get();
            $sqlQuery = Clan::toBase()->toSql();
            $this->LogsMethod($request, $user, $sqlQuery);
            return response()->json($clanes);
        }
        else{
            $clanes = Clan::where('id', $id)->first();
            $sqlQuery = Clan::where('id', $id)->toBase()->toSql();
            $this->LogsMethod($request, $user, $sqlQuery);
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
            $this->LogsMethod($request, $user);
            return response()->json(["message" => "Clan creado Correctamente", "clan" => $newClan], 200);
        } else {
            $newClan = Clan::create([
                "nombre" => $request->nombre,
                "nivel_clan" => 1,
                "lider" => $id
            ]);
            $admin= auth()->user();
            $user = User::find($id);
            $this->LogsMethod($request, $admin, ["lider"=>$user->toArray(), "nombreClan"=>$request->all()]);
            return response()->json(["message" => "Clan creado Correctamente", "data" => $newClan, 'lider' => $user], 200);
        }
    }

    public function show(Request $request, $id = null)
    {
        if ($id) {
            $user = auth()->user();
            $clan = Clan::where('lider', $id)->where('activate', true)->get();
            $query = Clan::where('lider', $id)->toBase()->toSql();
            $this->LogsMethod($request, $user, $query);
            return response()->json(['message' => "Tus clanes", "clanes" => $clan], 200);
        } else {
            $user = auth()->user();
            $clan = Clan::where('lider', $user->id)->where('activate', true)->get();
            $query = Clan::where('lider', $user->id)->toBase()->toSql();
            $this->LogsMethod($request, $user, $query);
            return response()->json(['message' => "Tus clanes", "clanes" => $clan], 200);
        }

    }
    public function delete(Request $request, $id)
    {
        $user = auth()->user();
        $clanid = Clan::where('lider', $user->id)->where('id', $id)->first();
        if (!$clanid) {
            return response()->json(['message' => 'este clan no te pertenece'], 200);
        }
        $clan = Clan::findOrFail($id);
        $clan->activate = false;
        $clan->save();
        $this->LogsMethod($request, $user, $clan->toArray());
        return response()->json(['clan desactivado' => $clan], 200);
    }
    public function deleteAdmin(Request $request, $id)
    {
        $user = auth()->user();
        $clan = Clan::where('id', $id)->first();
        if (!$clan) {
            return response()->json(["message" => "clan no encontrado"], 404);
        }
        $clan->activate = false;
        $clan->save();
        $this->LogsMethod($request, $user, $clan->toArray());
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
            return response()->json(['message' => 'este clan no te pertenece'], 404);
        }
        $clan = Clan::findOrFail($id);
        $clan->nombre = $request->nombre;
        $clan->save();
        $this->LogsMethod($request, $user, ["nuevo"=>$request->all(), "clanid"=>$id]);
        return response()->json(['message' => 'Clan actualizado correctamente'], 200);
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
            "date"=> now()->toString(),
            "data" =>  json_encode($data),
            "verb" => $request->method(),
        ]);
    }
}
