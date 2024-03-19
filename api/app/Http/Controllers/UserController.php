<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


use App\Models\Role;
use App\Mail\ValidatorMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

use App\Models\InventarioJugador;
use App\Models\Estadisticas;

class UserController extends Controller
{
    public function index($id = null)
    {
        if ($id) {
            $query = User::where('id', $id);
            $sqlQuery = $query->toSql();
            $user = $query->first();
            $this->LogsMethod(request(), auth()->user(), $sqlQuery);
            return response()->json(['message' => 'Usuario encontrado', 'user' => $user], 200);
        } else {
            $query = User::where('activate', true);
            $sqlQuery = $query->toSql();
            $users = $query->get();
            $this->LogsMethod(request(), auth()->user(), $sqlQuery);
            return response()->json(['message' => 'Usuarios activos', 'users' => $users], 200);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role_id' => Role::where('name', 'guest')->first()->id,
        ]);
        InventarioJugador::create([
            'user_id' => $user->id,
            'armas_id' => 1,
            'heroes_id' => 1,
        ]);
        Estadisticas::create([
            'user_id' => $user->id,
            'nivel' => 1,
            'experiencia' => 0,
            'puntuacion' => 0,
        ]);

        $token = auth()->login($user);

        $signedroute = URL::temporarySignedRoute(
            'activate',

            now()->addMinutes(10),
            ['token' => $token]
        );
        Mail::to($request->email)->send(new ValidatorMail($signedroute));
        $this->LogsMethod($request, $user, ["nombre" => $request->name, "email" => $request->email]);
        return response()->json(['msg' => 'Usuario creado con exito', 'body_message' => 'Revisar tu correo electronico para activar la cuenta']);
    }

    public function update(Request $request, $user_id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'email' => 'string|email|unique:users,email,' . $user_id,
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $user = User::findOrFail($user_id);
        if ($request->has('name')) {
            $user->name = $request->input('name');
        }
        if ($request->has('email')) {
            $user->email = $request->input('email');
        }
        if ($request->has('role_id')) {
            $user->role_id = $request->input('role_id');
        }
        $user->save();
        $this->LogsMethod($request, $user, ["modificacion" => $request->all(), "usuario" => $user_id]);
        return response()->json(['msg' => 'Usuario editado con éxito', 'data' => $user], 200);
    }

    public function delete($user_id)
    {
        $user = User::findOrFail($user_id);
        if (!$user) {
            return response()->json(["msg" => "Usuario no encontrado"], 404);
        }
        if ($user->activate == true) {
            $user->activate = false;
        }
        else {
            $user->activate = true;
        }
        $this->LogsMethod(request(), auth()->user(), $user->toArray());
        $user->save();

        return response()->json(['msg' => 'Usuario deshabilitado correctamente'], 200);
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
