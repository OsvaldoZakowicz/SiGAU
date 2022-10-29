<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    /**
     * atributos asignables en masa
     */
    protected $fillable = [
        'name',
        'iso31661'
    ];

    /**
     * Un pais tiene muchas provincias.
     * Retornar las provincias de un pais
     */
    public function provinces()
    {
        return $this->hasMany(Province::class, 'country_id');
    }
}
