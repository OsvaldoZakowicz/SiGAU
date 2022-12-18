<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class AmbientDescription extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'lights_quantity',
        'plugs_quantity',
        'size',
        'places_quantity',
        'ambient_types_id'
    ];

     /**
     * Attributes to include in the Audit.
     * @var array
     */
    protected $auditInclude = [
        'lights_quantity',
        'plugs_quantity',
        'size',
        'places_quantity',
        'ambient_types_id'
    ];

    /**
     * *una descripcion de ambiente pertenece a un tipo de ambiente.
     */
    public function ambient_type()
    {
        return $this->belongsTo(AmbientType::class,'ambient_types_id','id');
    }
}
