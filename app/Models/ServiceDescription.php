<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ServiceDescription extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'dia_llegada_boleta',
        'periodo_recaudacion',
        'dia_pago_servicio',
        'maximo_pagos_adeudados',
        'service_types_id'
    ];

    /**
     * Attributes to include in the Audit.
     * @var array
     */
    protected $auditInclude = [
        'dia_llegada_boleta',
        'periodo_recaudacion',
        'dia_pago_servicio',
        'maximo_pagos_adeudados',
        'service_types_id'
    ];

    /**
     * *una descripcion de servicio pertenece a un tipo de servicio.
     */
    public function service_type()
    {
        return $this->belongsTo(ServiceType::class,'service_types_id','id');
    }

    /**
     * *describe muchos servicios
     */
    public function services()
    {
        return $this->hasMany(Service::class,'service_description_id','id');
    }
}
