<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


use App\Models\Role;
use App\Mail\ValidatorMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class UserController extends Controller
{
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
        $code = $user->generateTwoFactorCode();
        $user->two_factor_secret = $code;
        $user->save();

        $token = auth()->login($user);

        $signedroute = URL::temporarySignedRoute(
            'activate',

            now()->addMinutes(10),
            ['token' => $token]
        );
        Mail::to($request->email)->send(new ValidatorMail($signedroute));
        return response()->json(['msg' => 'Usuario creado con exito', 'body_message' => 'Revisar tu correo electronico para activar la cuenta']);
    }

    public function edit(Request $request, $user_id) {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'email' => 'string|email|unique:users,email,'.$user_id,
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

        return response()->json(['msg' => 'Usuario editado con éxito', 'data' => $user], 200);
    }

    public function delete($user_id) {
        $user = User::findOrFail($user_id);
        if(!$user) {
            return response()->json(["msg" => "Usuario no encontrado"], 404);
        }

        $user->activate = 0;
        $user->save();

        return response()->json(['msg' => 'Usuario deshabilitado correctamente'], 200);
    }
}