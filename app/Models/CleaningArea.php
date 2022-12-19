<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CleaningArea extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'name',
        'cleaning_description',
        'cleaning_frequency',
        'cleaning_points'
    ];

    /**
     * Attributes to include in the Audit.
     * @var array
     */
    protected $auditInclude = [
        'name',
        'cleaning_description',
        'cleaning_frequency',
        'cleaning_points'
    ];

    /**
     * *esta en muchos ambientes
     */

}
