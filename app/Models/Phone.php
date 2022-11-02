<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    /**
     * atributos asignables masivamente
     */
    protected $fillable = ['number'];

    /**
     * pertenece a una persona
     */
    public function people()
    {
        return $this->belongsTo(Person::class, 'people_id');
    }
}
