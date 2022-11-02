<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;

    /**
     * atributos asignables masivamente
     */
    protected $fillable = ['name'];

    /**
     * un genero aplica para muchas personas.
     */
    public function people()
    {
        return $this->hasMany(Person::class, 'gender_id');
    }
}
