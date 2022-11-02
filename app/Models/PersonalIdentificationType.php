<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalIdentificationType extends Model
{
    use HasFactory;

    //clave primaria
    protected $primaryKey = 'identification_type';
    //tipo de clave primaria
    protected $keyType = 'string';
    //NO incremental
    public $incrementing = false;

    /**
     * atributos asignables masivamente
     */
    protected $fillable = ['format'];

    /**
     * un tipo de identificacion aplica para
     * muchas personas.
     */
    public function people()
    {
        return $this->hasMany(Person::class, 'identification_type_id', 'identification_type');
    }
}
