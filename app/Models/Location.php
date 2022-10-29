<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    /**
     * atributos asignables en masa
     */
    protected $fillable = [
        'name',
        'postal_code'
    ];

    /**
     * Una ubicacion pertenece a una provincia
     * Retornar la provincia de la ubicacion.
     */
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
