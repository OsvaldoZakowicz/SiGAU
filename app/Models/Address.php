<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    /**
     * atributos asignables masivamente
     */
    protected $fillable = [
        'street',
        'street_number',
        'house_number',
        'floor_number',
        'department_number',
        'location_id',
        'people_id'
    ];

    /**
     * *direccion de una persona.
     */
    public function people()
    {
        return $this->hasOne(Person::class, 'address_id','id');
    }

    /**
     * es parte de una ubicacion o localidad.
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
