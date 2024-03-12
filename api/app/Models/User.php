<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Laravel\Fortify\TwoFactorAuthenticatable;
use PragmaRX\Google2FA\Google2FA;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'activate',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'codigoVerificado'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'codigoVerificado'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'activate' => 'boolean',
        'codigoVerificado'=> 'boolean',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function jugador()
    {
        return $this->belongsTo(Jugador::class);
    }

    public function twoFactorOptions()
    {
        return [
            'recovery_codes' => true,
        ];
    }

    public function generateTwoFactorCode()
    {
        $code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $this->two_factor_secret = $code;
        $this->save();
        return $code;
    }


}
