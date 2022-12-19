<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Service extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'connection_number',
        'service_owner',
        'cuit',
        'house_id',
        'service_description_id'
    ];

    /**
     * Attributes to include in the Audit.
     * @var array
     */
    protected $auditInclude = [
        'connection_number',
        'service_owner',
        'cuit',
        'house_id',
        'service_description_id'
    ];

    /**
     * *es de un tipo de servicio.
     */
    public function service_description()
    {
        return $this->belongsTo(ServiceDescription::class,'service_description_id','id');
    }

    /**
     * *es de una casa.
     */
    public function house()
    {
        return $this->belongsTo(House::class,'house_id','id');
    }

}
