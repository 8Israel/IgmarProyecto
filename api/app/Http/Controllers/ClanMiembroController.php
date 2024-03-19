<?php

namespace App\Http\Controllers;

use App\Models\ClanMiembro;
use App\Models\Clan;
use App\Models\Logs;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class ClanMiembroController extends Controller
{
    public function index(Request $request, $id)
    {
        $query = User::whereHas('clanMiembro', function ($query) use ($id) {
            $query->where('clan_id', $id);
        })->with('clanMiembro');
        $sqlQuery = $query->toSql();
        $usuarios = $query->get();
        if ($usuarios->count() == 0) {
            $this->LogsMethod($request, auth()->user(), $sqlQuery);
            return response()->json(['message' => 'El clan no cuenta con miembros'], 404);
        }
        $this->LogsMethod($request, auth()->user(), $sqlQuery);
        return response()->json($usuarios);
    }

    public function store(Request $request, $id, $userId = null)
    {
        if (is_null($userId)) {
            $user = auth()->user()->id;
            if (User::where('id', $user)->exists() && Clan::where('id', $id)->exists()) {
                if (ClanMiembro::where('user_id', $user)->where('clan_id', $id)->exists()) {
                    return response()->json(['message' => 'El usuario ya es miembro del clan'], 400);
                }
                $this->LogsMethod($request, auth()->user(), ["idClan" => $id]);
                $nuevo = ClanMiembro::create([
                    'user_id' => $user,
                    'clan_id' => $id,
                    'rango' => 'miembro',
                ]);

                return response()->json(['message' => 'Usuario agregado correctamente al clan', 'data' => $nuevo], 200);
            } else {
                return response()->json(['message' => 'El clan o el usuario no existe'], 404);
            }
        } else {
            if (User::where('id', $userId)->exists() && Clan::where('id', $id)->exists()) {
                if (ClanMiembro::where('user_id', $userId)->where('clan_id', $id)->exists()) {
                    return response()->json(['message' => 'El usuario ya es miembro del clan'], 400);
                }
                $this->LogsMethod($request, auth()->user(), ["idClan" => $id, "idUsuario" => $userId]);
                $nuevo = ClanMiembro::create([
                    'user_id' => $userId,
                    'clan_id' => $id,
                    'rango' => 'miembro',
                ]);

                return response()->json(['message' => 'Usuario agregado correctamente al clan', 'data' => $nuevo], 200);
            } else {
                return response()->json(['message' => 'El clan o el usuario no existe'], 404);
            }
        }
    }
    public function update(Request $request, $id, $userId)
    {
        $validator = Validator::make($request->all(), [
            'rango' => 'required|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $clanMiembro = ClanMiembro::where('user_id', $userId)
            ->where('clan_id', $id)
            ->first();

        if (!$clanMiembro) {
            return response()->json(['error' => 'El usuario no pertenece a este clan'], 404);
        }
        $this->LogsMethod($request, auth()->user(), ["rango" => $request->rango, "usuario" => $userId, "clan" => $id]);
        $clanMiembro->rango = $request->rango;
        $clanMiembro->save();
        return response()->json(['message' => 'Rango actualizado correctamente'], 200);
    }

    public function destroy(Request $request, $id, $userId = null)
    {
        $userId = $userId ?: auth()->id();
        $clanMiembro = ClanMiembro::where('clan_id', $id)->where('user_id', $userId)->first();
        if (!$clanMiembro) {
            return response()->json(['error' => 'El usuario no pertenece a este clan'], 404);
        }
        if ($clanMiembro->user_id != $userId) {
            return response()->json(['error' => 'No tienes permiso para eliminar este miembro del clan'], 403);
        }
        $this->LogsMethod($request, auth()->user(), ["clan" => $id, "miembro" => $userId]);
        $clanMiembro->delete();
        return response()->json(['error' => 'Usuario eliminado correctamente del clan'], 200);
    }
    public function getUserClans($userId = null)
    {
        $userId = $userId ?: auth()->id();

        $clanMiembrosQuery = ClanMiembro::where('user_id', $userId);
        $clanMiembrosSqlQuery = $clanMiembrosQuery->toSql();
        $clanMiembros = $clanMiembrosQuery->get();

        if ($clanMiembros->isEmpty()) {
            return response()->json(['error' => 'el usuario no pertenece a ningun clan'], 404);
        }
        
        $clanIds = $clanMiembros->pluck('clan_id');
        $clansQuery = Clan::whereIn('id', $clanIds);
        $clansSqlQuery = $clansQuery->toSql();
        $clans = $clansQuery->get();

        $this->LogsMethod(request(), auth()->user(), ["user"=>$userId,"Id Miembro"=>$clanMiembrosSqlQuery, "clanes"=>$clansSqlQuery]);
        
        return response()->json(['clanes' => $clans], 200);
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