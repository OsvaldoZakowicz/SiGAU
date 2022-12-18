<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ServiceType extends Model implements Auditable
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

    /**
     * *un tipo de servicio tiene muchas descripciones de servicio
     */
    public function service_descriptions()
    {
        return $this->hasMany(ServiceDescription::class,'service_types_id','id');
    }
}
