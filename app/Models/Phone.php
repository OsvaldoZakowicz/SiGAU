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
    protected $fillable = [
        'number',
        'people_id'
    ];

    /**
     * lo tiene una persona
     */
    public function people()
    {
        return $this->hasOne(Person::class, 'phone_id','id');
    }
}
