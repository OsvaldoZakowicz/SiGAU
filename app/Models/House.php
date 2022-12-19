<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class House extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'block',
        'neighborhood',
        'address_id'
    ];

    /**
     * Attributes to include in the Audit.
     * @var array
     */
    protected $auditInclude = [
        'block',
        'neighborhood',
        'address_id'
    ];

    /**
     * *tiene una direccion
     */
    public function address()
    {
        return $this->belongsTo(Address::class,'address_id','id');
    }

}
