<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MorbidityReport extends Model
{
    use SoftDeletes;
    
    /**
     * The attributes that are not mass assignable.
     * 
     * @var Array
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * A morbidity report belongs to a case report.
     * 
     * @return BelongsTo
     */
    public function report()
    {
        return $this->belongsTo('App\Report', 'report_id');
    }
}
