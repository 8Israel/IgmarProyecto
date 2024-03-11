<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController;
use PragmaRX\Google2FA\Google2FA;

class TwoFactorController extends TwoFactorAuthenticationController
{
    public function authenticate(Request $request)
    {
        $user = $request->user();

        if ($user->two_factor_secret) {
            if ($this->attemptTwoFactorAuthentication($request)) {
                $token = $user->createToken('two-factor-auth')->plainTextToken;

                return response()->json(['token' => $token]);
            }
            return response()->json(['message' => 'Código de autenticación incorrecto'], 401);
        }
        return response()->json(['message' => 'La autenticación de dos factores no está habilitada para este usuario'], 422);
    }

    public function show(Request $request)
    {
        $user = $request->user();

        if ($user->two_factor_secret) {
            return view('mails.two-factor-challenge');
        }
        return response()->json(['message' => 'La autenticación de dos factores no está habilitada para este usuario'], 422);
    }
}
