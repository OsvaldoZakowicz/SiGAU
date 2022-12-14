<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
//para el paquete roles y permisos
use Spatie\Permission\Traits\HasRoles;
//para el paquete auditable
use OwenIt\Auditing\Contracts\Auditable;

/**
 * *Verificacion de email:
 * *El modelo debe implementar la interfaz MustVerifyEmail
 * - esta interfaz tiene metodos de verificacion de email que el modelo User debe implmentar,
 * pero lo hace a traves de herencia extendiendo del alias Authenticatable (Auth\User), alli esta
 * un trait MustVerifyEmail (no confundir con la interfaz) que tiene los metodos implementados.
 */
class User extends Authenticatable implements MustVerifyEmail, Auditable
{
    use HasApiTokens, HasFactory, Notifiable;
    //para el paquete roles y permisos
    use HasRoles;
    //para el paquete auditable
    use \OwenIt\Auditing\Auditable;

    /**
     * *atributos asignados masivamente
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * *atributos que seran auditados
     * @var array
     */
    protected $auditInclude = [
        'email',
        'password',
        'email_verified_at'
    ];


    /**
     * *esta asociado a una persona
     */
    public function people()
    {
        return $this->belongsTo(Person::class);
    }
}
