<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class AmbientType extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    //fillables
    protected $fillable = ['name', 'description'];

     /**
     * Attributes to include in the Audit.
     * @var array
     */
    protected $auditInclude = [
        'name',
        'description',
    ];

}
