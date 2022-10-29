<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    /**
     * atributos asignables en masa
     */
    protected $fillable = [
        'name',
        'iso31662'
    ];

    /**
     * Una provincia pertenece a un pais
     * Retornar el pais de la provincia.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Una provincia tiene muchas localidades
     * Retornar localidades de la provincia.
     */
    public function locations()
    {
        return $this->hasMany(Location::class, 'province_id');
    }
}
