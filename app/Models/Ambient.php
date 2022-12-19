<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Ambient extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'quantity',
        'house_id',
        'ambient_description_id'
    ];

    /**
     * Attributes to include in the Audit.
     * @var array
     */
    protected $auditInclude = [
        'quantity',
        'house_id',
        'ambient_description_id'
    ];

    /**
     * *pertenece a una casa
     */
    public function house()
    {
        return $this->belongsTo(House::class,'house_id','id');
    }

    /**
     * *tiene una descripcion de ambiente
     */
    public function ambient_description()
    {
        return $this->belongsTo(AmbientDescription::class,'ambient_description_id','id');
    }

}
