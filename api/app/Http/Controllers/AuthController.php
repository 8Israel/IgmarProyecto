<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\ValidatorMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
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
            'role_id' => Role::where('name', 'user')->first()->id,
        ]);
        $token = JWTAuth::fromUser($user);

        $signedroute = URL::temporarySignedRoute(
            'activate',

            now()->addMinutes(10),
            ['token' => $token]
        );
        Mail::to($request->email)->send(new ValidatorMail($signedroute));
        return response()->json(['msg' => 'Usuario creado exitosamente', 'data' => $user]);
    }

    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(["msg" => "Usuario no encontrado"], 404);
        }
        if (!$user->activate)
            return response()->json(['msg'=>'El usuario no esta activo'],401);

        return response()->json(['msg' => 'Inicio de sesión correcto', 'data' => $user, 'token' => $token], 200);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function getIDbyToken($token){
        $payload = JWTAuth::parseToken($token);
        return $payload->getPayload()['sub'];
    }


    public function activate($token)
    {
        $url='http://127.0.0.1:8000/api/resendemail/'.$token;
        try{
            JWTAuth::parseToken($token)->authenticate();
        }catch(JWTException $e){
            return response()->view('ErrorEmail',['reenviar_email'=>$url]);
        }
        $user=User::find($this->getIDbyToken($token));
        if(!$user)
            return response()->view('mails.ErrorEmail',['reenviar_email'=>$url]);
        $user->activate=true;
        $user->save();
        return response()->view('mails.AcceptedEmail');

    }
}
