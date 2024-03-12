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
use Illuminate\Support\Facades\Auth;
use App\Mail\TwoFactorCodeMail;
use PragmaRX\Google2FA\Google2FA;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;


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

    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth()->user(); 
        if (!$user) {
            return response()->json(["msg" => "Usuario no encontrado"], 404);
        }

        $this->sendTwoFactorCodeByEmail($user);


        if ($user->two_factor_secret) {
            $this->sendTwoFactorCodeByEmail($user);

            return response()->json(['msg' => 'Redireccionando a la autenticación de dos factores', "token" => $token], 200);
        }


        return response()->json(['msg' => 'Inicio de sesión correcto', 'data' => $user, 'token' => $token], 200);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        $user = JWTAuth::user();
        $user->codigoVerificado = false;
        $user->save();
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(JWTAuth::refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ]);
    }

    public function getIDbyToken($token)
    {
        $payload = JWTAuth::parseToken($token);
        return $payload->getPayload()['sub'];
    }


    public function activate($token)
    {
        $url = 'http://127.0.0.1:8000/api/resendemail/' . $token;
        try {
            JWTAuth::parseToken($token)->authenticate();
        } catch (JWTException $e) {
            return response()->view('ErrorEmail', ['reenviar_email' => $url]);
        }
        $user = User::find($this->getIDbyToken($token));
        if (!$user)
            return response()->view('mails.ErrorEmail', ['reenviar_email' => $url]);
        $user->activate = true;
        $user->save();
        return response()->view('mails.AcceptedEmail');
    }

    protected function sendTwoFactorCodeByEmail($user)
    {
        $code = $user->generateTwoFactorCode();
        $email = $user->email;
        Mail::to($email)->send(new TwoFactorCodeMail($code));
    }

    public function verifyTwoFactorCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'two_factor_code' => 'required|digits:6',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $user = JWTAuth::user();
        if ($user->two_factor_secret == $request->two_factor_code) {
            $user->codigoVerificado = true;
            $user->save();
            JWTAuth::parseToken()->invalidate();
            $token = JWTAuth::fromUser($user);

            return response()->json(['message' => 'Código de autenticación válido','data' => $user, 'token' => $token], 200);
        }
        return response()->json(['error' => 'Código de autenticación incorrecto'], 401);
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