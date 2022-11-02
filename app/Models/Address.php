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
        'streetNumber',
        'houseNumber',
        'floorNumber',
        'departmentNumber'
    ];

    /**
     * pertenece a una persona.
     */
    public function people()
    {
        return $this->belongsTo(Person::class, 'people_id');
    }

    /**
     * es parte de una ubicacion o localidad.
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
