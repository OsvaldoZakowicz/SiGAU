<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    /**
     * atributos asignables masivamente
     */
    protected $fillable = [
        'identification_type_id',
        'identificationNumber',
        'lastName',
        'firstName',
        'gender_id'
    ];

    /**
     * una persona tiene un tipo de identificacion
     */
    public function personalIdentificationType()
    {
        return $this->belongsTo(PersonalIdentificationType::class, 'identification_type_id', 'identification_type');
    }

    /**
     * una persona tiene un genero.
     */
    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    /**
     * una persona tiene una o mas cuentas de acceso
     * al sistema.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'people_id');
    }

    /**
     * tiene un telefono.
     */
    public function phone()
    {
        return $this->hasOne(Phone::class, 'people_id');
    }

    /**
     * tiene una direccion.
     */
    public function address()
    {
        return $this->hasOne(Address::class, 'people_id');
    }
}
