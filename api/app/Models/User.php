<?php

namespace App\Models;
    
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

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
    
    public function twoFactorOptions()
    {
        return [
            'recovery_codes' => true,
        ];
    }

    public function generateTwoFactorCode()
    {
        $code = '5'.str_pad(rand(0, 999999), 5, '0', STR_PAD_LEFT);
        $code = substr($code, 0, 6);
        $this->two_factor_secret = $code;
        $this->save();
        return $code;
    }
    public function clanMiembro()
    {
        return $this->hasMany(ClanMiembro::class, 'user_id');
    }
    public function estadisticas()
    {
        return $this->hasOne(Estadisticas::class);
    }
    public function inventario()
    {
        return $this->hasOne(InventarioJugador::class);
    }
    public function Logs()
    {
        return $this->hasMany(Logs::class);
    }
}
